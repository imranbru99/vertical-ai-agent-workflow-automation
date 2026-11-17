<?php

namespace Database\Seeders;

use App\Enums\AgentStatus;
use App\Enums\AutomationRunStatus;
use App\Enums\UserRole;
use App\Enums\WorkflowStatus;
use App\Models\AutomationRun;
use App\Models\IndustryVertical;
use App\Models\Module;
use App\Models\Pipeline;
use App\Models\TimeSavingMetric;
use App\Models\User;
use App\Models\VerticalAgent;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use App\Services\ModuleRegistry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $users = $this->seedUsers();
        $verticals = $this->seedVerticals();
        $modules = $this->seedModules();
        $workflows = $this->seedWorkflows($users, $verticals, $modules);
        $agents = $this->seedAgents($verticals, $workflows);
        $this->seedPipelines($verticals);
        $this->seedRuns($users, $workflows, $agents);
        $this->seedMetrics($modules, $workflows, $verticals);

        app(ModuleRegistry::class)->clearCache();
    }

    /** @return array<string, User> */
    protected function seedUsers(): array
    {
        $defs = [
            'super' => ['name' => 'Imran Ahmed', 'email' => 'admin@vertical-ai.test', 'role' => UserRole::SuperAdmin, 'company' => 'ImranDev BD', 'job_title' => 'Platform Architect'],
            'admin' => ['name' => 'Ayesha Rahman', 'email' => 'ops-admin@vertical-ai.test', 'role' => UserRole::Admin, 'company' => 'Northwind Ops', 'job_title' => 'Ops Admin'],
            'manager' => ['name' => 'Karim Hossain', 'email' => 'manager@vertical-ai.test', 'role' => UserRole::Manager, 'company' => 'Northwind Ops', 'job_title' => 'Automation Manager'],
            'staff' => ['name' => 'Nadia Chowdhury', 'email' => 'staff@vertical-ai.test', 'role' => UserRole::Staff, 'company' => 'Northwind Ops', 'job_title' => 'Workflow Specialist'],
            'client' => ['name' => 'Client Partner', 'email' => 'client@vertical-ai.test', 'role' => UserRole::Client, 'company' => 'Acme Retail', 'job_title' => 'COO'],
            'demo' => ['name' => 'Demo User', 'email' => config('vertical-ai.demo.email'), 'role' => UserRole::Demo, 'company' => 'Demo Co', 'job_title' => 'Evaluator'],
        ];

        $users = [];
        foreach ($defs as $key => $def) {
            $users[$key] = User::query()->updateOrCreate(
                ['email' => $def['email']],
                [
                    'name' => $def['name'],
                    'password' => config('vertical-ai.demo.password'),
                    'role' => $def['role'],
                    'company' => $def['company'],
                    'job_title' => $def['job_title'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        return $users;
    }

    /** @return array<string, IndustryVertical> */
    protected function seedVerticals(): array
    {
        $items = [
            ['name' => 'Cross-Industry Automation', 'slug' => 'cross-industry', 'typical_roi_percent' => 312, 'default_modules' => ['sales_automation', 'ops_orchestration', 'support_copilot']],
            ['name' => 'Retail & Commerce', 'slug' => 'retail', 'typical_roi_percent' => 280, 'default_modules' => ['sales_automation', 'catalog_scrape', 'support_copilot']],
            ['name' => 'Professional Services', 'slug' => 'services', 'typical_roi_percent' => 265, 'default_modules' => ['ops_orchestration', 'hr_onboarding', 'pdf_reporting']],
            ['name' => 'Healthcare Ops', 'slug' => 'healthcare', 'typical_roi_percent' => 240, 'default_modules' => ['compliance_audit', 'support_copilot', 'attendance_bridge']],
            ['name' => 'Financial Services', 'slug' => 'finance', 'typical_roi_percent' => 295, 'default_modules' => ['finance_reconcile', 'compliance_audit', 'pdf_reporting']],
        ];

        $verticals = [];
        foreach ($items as $item) {
            $verticals[$item['slug']] = IndustryVertical::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => "Vertical playbooks and agents for {$item['name']}.",
                    'accent_color' => '#0F766E',
                    'is_active' => true,
                    'default_modules' => $item['default_modules'],
                    'typical_roi_percent' => $item['typical_roi_percent'],
                ]
            );
        }

        return $verticals;
    }

    /** @return array<string, Module> */
    protected function seedModules(): array
    {
        $catalog = [
            ['key' => 'sales_automation', 'name' => 'Sales Automation', 'category' => 'sales', 'hours' => 28, 'core' => true, 'enabled' => true],
            ['key' => 'ops_orchestration', 'name' => 'Ops Orchestration', 'category' => 'operations', 'hours' => 36, 'core' => true, 'enabled' => true],
            ['key' => 'support_copilot', 'name' => 'Support Copilot', 'category' => 'support', 'hours' => 32, 'core' => false, 'enabled' => true],
            ['key' => 'hr_onboarding', 'name' => 'HR Onboarding Agent', 'category' => 'hr', 'hours' => 18, 'core' => false, 'enabled' => true],
            ['key' => 'finance_reconcile', 'name' => 'Finance Reconciliation', 'category' => 'finance', 'hours' => 22, 'core' => false, 'enabled' => true],
            ['key' => 'compliance_audit', 'name' => 'Compliance Audit Trail', 'category' => 'compliance', 'hours' => 14, 'core' => false, 'enabled' => false],
            ['key' => 'knowledge_rag', 'name' => 'Knowledge RAG Hub', 'category' => 'knowledge', 'hours' => 20, 'core' => false, 'enabled' => true],
            ['key' => 'attendance_bridge', 'name' => 'Attendance Machine Bridge', 'category' => 'workforce', 'hours' => 12, 'core' => false, 'enabled' => false],
            ['key' => 'pdf_reporting', 'name' => 'Unicode PDF Reporting', 'category' => 'reporting', 'hours' => 10, 'core' => false, 'enabled' => true],
            ['key' => 'catalog_scrape', 'name' => 'AI Catalog Scraper', 'category' => 'data', 'hours' => 16, 'core' => false, 'enabled' => true],
            ['key' => 'pipeline_routing', 'name' => 'Pipeline Smart Routing', 'category' => 'operations', 'hours' => 15, 'core' => false, 'enabled' => true],
            ['key' => 'roi_analytics', 'name' => 'ROI & Time Analytics', 'category' => 'analytics', 'hours' => 8, 'core' => true, 'enabled' => true],
        ];

        $modules = [];
        foreach ($catalog as $i => $item) {
            $modules[$item['key']] = Module::query()->updateOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'category' => $item['category'],
                    'description' => "Enable or disable {$item['name']} for your business. Estimated {$item['hours']} hours saved weekly when active.",
                    'icon' => 'heroicon-o-cpu-chip',
                    'is_enabled' => $item['enabled'],
                    'is_core' => $item['core'],
                    'sort_order' => $i + 1,
                    'settings' => ['sla_minutes' => 15, 'notify_slack' => true],
                    'estimated_hours_saved_weekly' => $item['hours'],
                ]
            );
        }

        return $modules;
    }

    /**
     * @param  array<string, User>  $users
     * @param  array<string, IndustryVertical>  $verticals
     * @param  array<string, Module>  $modules
     * @return array<int, Workflow>
     */
    protected function seedWorkflows(array $users, array $verticals, array $modules): array
    {
        $defs = [
            ['name' => 'Lead Intake to Qualified Opportunity', 'module' => 'sales_automation', 'vertical' => 'cross-industry', 'minutes' => 42],
            ['name' => 'Ticket Triage & Auto-Reply', 'module' => 'support_copilot', 'vertical' => 'retail', 'minutes' => 28],
            ['name' => 'Ops Exception Escalation', 'module' => 'ops_orchestration', 'vertical' => 'cross-industry', 'minutes' => 35],
            ['name' => 'Employee Day-One Pack', 'module' => 'hr_onboarding', 'vertical' => 'services', 'minutes' => 55],
            ['name' => 'Daily Ledger Match', 'module' => 'finance_reconcile', 'vertical' => 'finance', 'minutes' => 48],
            ['name' => 'Multilingual Ops PDF Pack', 'module' => 'pdf_reporting', 'vertical' => 'services', 'minutes' => 22],
        ];

        $workflows = [];
        foreach ($defs as $def) {
            $slug = Str::slug($def['name']);
            $workflow = Workflow::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $def['name'],
                    'industry_vertical_id' => $verticals[$def['vertical']]->id,
                    'module_id' => $modules[$def['module']]->id,
                    'owner_id' => $users['manager']->id,
                    'status' => WorkflowStatus::Active,
                    'trigger_type' => 'event',
                    'description' => "Automates {$def['name']} with measurable time savings.",
                    'definition' => ['version' => 1, 'nodes' => ['intake', 'qualify', 'route', 'automate', 'report']],
                    'steps_count' => 5,
                    'runs_count' => 0,
                    'avg_minutes_saved' => $def['minutes'],
                    'is_published' => true,
                ]
            );

            foreach (['Intake', 'Qualify', 'Route', 'Automate', 'Report'] as $i => $step) {
                WorkflowStep::query()->updateOrCreate(
                    ['workflow_id' => $workflow->id, 'position' => $i + 1],
                    [
                        'name' => $step,
                        'step_type' => $i === 3 ? 'ai_action' : 'action',
                        'config' => ['retry' => 2],
                        'estimated_seconds' => 20 + ($i * 8),
                    ]
                );
            }

            $workflows[] = $workflow;
        }

        return $workflows;
    }

    /**
     * @param  array<string, IndustryVertical>  $verticals
     * @param  array<int, Workflow>  $workflows
     * @return array<int, VerticalAgent>
     */
    protected function seedAgents(array $verticals, array $workflows): array
    {
        $agents = [];
        $specialties = ['Sales', 'Support', 'Ops', 'Finance', 'HR'];

        foreach ($workflows as $i => $workflow) {
            $name = $specialties[$i % count($specialties)].' Vertical Agent';
            $agents[] = VerticalAgent::query()->updateOrCreate(
                ['slug' => Str::slug($name.'-'.$workflow->id)],
                [
                    'name' => $name,
                    'specialty' => strtolower($specialties[$i % count($specialties)]),
                    'industry_vertical_id' => $workflow->industry_vertical_id,
                    'workflow_id' => $workflow->id,
                    'status' => AgentStatus::Idle,
                    'model_provider' => 'openai',
                    'model_name' => 'gpt-4.1',
                    'system_prompt' => "You are a {$name} specialized in industry workflow automation.",
                    'capabilities' => ['classify', 'summarize', 'route', 'generate'],
                    'tasks_completed' => 12 + $i * 3,
                    'success_rate' => 94.5 + $i,
                    'is_enabled' => true,
                ]
            );
        }

        return $agents;
    }

    /** @param  array<string, IndustryVertical>  $verticals */
    protected function seedPipelines(array $verticals): void
    {
        $defs = [
            ['name' => 'Revenue Ops Pipeline', 'vertical' => 'cross-industry', 'stage' => 'qualify'],
            ['name' => 'Customer Care Pipeline', 'vertical' => 'retail', 'stage' => 'resolve'],
            ['name' => 'Close & Report Pipeline', 'vertical' => 'finance', 'stage' => 'reconcile'],
        ];

        foreach ($defs as $def) {
            Pipeline::query()->updateOrCreate(
                ['slug' => Str::slug($def['name'])],
                [
                    'name' => $def['name'],
                    'industry_vertical_id' => $verticals[$def['vertical']]->id,
                    'stage' => $def['stage'],
                    'description' => "Operational pipeline for {$def['name']}.",
                    'stages' => ['intake', 'qualify', 'route', 'automate', 'report'],
                    'items_in_flight' => random_int(4, 18),
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * @param  array<string, User>  $users
     * @param  array<int, Workflow>  $workflows
     * @param  array<int, VerticalAgent>  $agents
     */
    protected function seedRuns(array $users, array $workflows, array $agents): void
    {
        foreach ($workflows as $i => $workflow) {
            for ($n = 0; $n < 3; $n++) {
                AutomationRun::query()->create([
                    'workflow_id' => $workflow->id,
                    'vertical_agent_id' => $agents[$i]->id ?? null,
                    'triggered_by' => $users['demo']->id,
                    'status' => AutomationRunStatus::Completed,
                    'started_at' => now()->subHours($n + 1),
                    'finished_at' => now()->subHours($n + 1)->addMinutes(2),
                    'duration_seconds' => 90 + $n * 10,
                    'minutes_saved' => (int) $workflow->avg_minutes_saved,
                    'input_payload' => ['source' => 'demo-seed'],
                    'output_payload' => ['ok' => true],
                ]);
                $workflow->increment('runs_count');
            }
        }
    }

    /**
     * @param  array<string, Module>  $modules
     * @param  array<int, Workflow>  $workflows
     * @param  array<string, IndustryVertical>  $verticals
     */
    protected function seedMetrics(array $modules, array $workflows, array $verticals): void
    {
        foreach (range(0, 13) as $day) {
            TimeSavingMetric::query()->create([
                'module_id' => $modules['ops_orchestration']->id,
                'workflow_id' => $workflows[0]->id,
                'industry_vertical_id' => $verticals['cross-industry']->id,
                'metric_date' => now()->subDays($day)->toDateString(),
                'hours_saved' => random_int(6, 18),
                'tasks_automated' => random_int(20, 80),
                'estimated_cost_saved' => random_int(300, 900),
                'department' => ['sales', 'operations', 'support'][$day % 3],
            ]);
        }
    }
}
