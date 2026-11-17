<?php

namespace App\Services;

use App\Models\AutomationRun;
use App\Models\TimeSavingMetric;
use Illuminate\Support\Facades\DB;

class RoiCalculator
{
    public function recordRun(AutomationRun $run): TimeSavingMetric
    {
        $hours = max(1, (int) ceil($run->minutes_saved / 60));
        $hourlyRate = (float) config('vertical-ai.hourly_cost_rate', 45);

        return TimeSavingMetric::query()->create([
            'module_id' => $run->workflow?->module_id,
            'workflow_id' => $run->workflow_id,
            'industry_vertical_id' => $run->workflow?->industry_vertical_id,
            'metric_date' => now()->toDateString(),
            'hours_saved' => $hours,
            'tasks_automated' => 1,
            'estimated_cost_saved' => round($hours * $hourlyRate, 2),
            'department' => $run->workflow?->module?->category ?? 'operations',
        ]);
    }

    /** @return array{hours_saved:int,tasks_automated:int,cost_saved:float,roi_percent:float} */
    public function dashboardSummary(): array
    {
        $totals = TimeSavingMetric::query()
            ->selectRaw('COALESCE(SUM(hours_saved),0) as hours_saved')
            ->selectRaw('COALESCE(SUM(tasks_automated),0) as tasks_automated')
            ->selectRaw('COALESCE(SUM(estimated_cost_saved),0) as cost_saved')
            ->first();

        $platformCost = (float) config('vertical-ai.monthly_platform_cost', 1200);
        $costSaved = (float) ($totals->cost_saved ?? 0);
        $roi = $platformCost > 0 ? round(($costSaved / $platformCost) * 100, 1) : 0;

        return [
            'hours_saved' => (int) ($totals->hours_saved ?? 0),
            'tasks_automated' => (int) ($totals->tasks_automated ?? 0),
            'cost_saved' => $costSaved,
            'roi_percent' => $roi,
        ];
    }

    /** @return list<array{department:string,hours:int}> */
    public function hoursByDepartment(): array
    {
        return TimeSavingMetric::query()
            ->select('department', DB::raw('SUM(hours_saved) as hours'))
            ->groupBy('department')
            ->orderByDesc('hours')
            ->get()
            ->map(fn ($row) => [
                'department' => $row->department ?? 'general',
                'hours' => (int) $row->hours,
            ])
            ->all();
    }
}
