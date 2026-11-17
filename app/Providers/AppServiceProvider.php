<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\VerticalAgent;
use App\Models\Workflow;
use App\Policies\ModulePolicy;
use App\Policies\VerticalAgentPolicy;
use App\Policies\WorkflowPolicy;
use App\Services\ModuleRegistry;
use App\Services\RoiCalculator;
use App\Services\WorkflowAutomationService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ModuleRegistry::class);
        $this->app->singleton(RoiCalculator::class);
        $this->app->singleton(WorkflowAutomationService::class);
    }

    public function boot(): void
    {
        Gate::policy(Module::class, ModulePolicy::class);
        Gate::policy(Workflow::class, WorkflowPolicy::class);
        Gate::policy(VerticalAgent::class, VerticalAgentPolicy::class);
    }
}
