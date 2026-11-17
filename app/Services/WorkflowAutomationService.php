<?php

namespace App\Services;

use App\Enums\AgentStatus;
use App\Enums\AutomationRunStatus;
use App\Enums\WorkflowStatus;
use App\Models\AutomationRun;
use App\Models\User;
use App\Models\VerticalAgent;
use App\Models\Workflow;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class WorkflowAutomationService
{
    public function __construct(
        protected ModuleRegistry $modules,
        protected RoiCalculator $roiCalculator,
    ) {}

    public function dispatch(Workflow $workflow, ?User $actor = null, array $payload = []): AutomationRun
    {
        if ($workflow->status !== WorkflowStatus::Active) {
            throw new RuntimeException('Only active workflows can be dispatched.');
        }

        if ($workflow->module && ! $this->modules->isEnabled($workflow->module->key)) {
            throw new RuntimeException("Module [{$workflow->module->key}] is disabled.");
        }

        return DB::transaction(function () use ($workflow, $actor, $payload) {
            /** @var VerticalAgent|null $agent */
            $agent = $workflow->agents()->where('is_enabled', true)->first();

            if ($agent) {
                $agent->update(['status' => AgentStatus::Running]);
            }

            $run = AutomationRun::query()->create([
                'workflow_id' => $workflow->id,
                'vertical_agent_id' => $agent?->id,
                'triggered_by' => $actor?->id,
                'status' => AutomationRunStatus::Running,
                'started_at' => now(),
                'input_payload' => $payload,
                'minutes_saved' => (int) max(1, round((float) $workflow->avg_minutes_saved)),
            ]);

            $duration = max(5, (int) $workflow->steps()->sum('estimated_seconds'));

            $run->update([
                'status' => AutomationRunStatus::Completed,
                'finished_at' => now(),
                'duration_seconds' => $duration,
                'output_payload' => [
                    'result' => 'success',
                    'steps_executed' => $workflow->steps_count,
                    'message' => "Workflow [{$workflow->name}] completed successfully.",
                ],
            ]);

            $workflow->increment('runs_count');

            if ($agent) {
                $agent->update([
                    'status' => AgentStatus::Idle,
                    'tasks_completed' => $agent->tasks_completed + 1,
                    'success_rate' => min(99.9, (float) $agent->success_rate + 0.1),
                ]);
            }

            $this->roiCalculator->recordRun($run);

            return $run->fresh(['workflow', 'agent', 'triggeredBy']);
        });
    }
}
