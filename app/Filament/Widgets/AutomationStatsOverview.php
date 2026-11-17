<?php

namespace App\Filament\Widgets;

use App\Models\Module;
use App\Models\VerticalAgent;
use App\Models\Workflow;
use App\Services\ModuleRegistry;
use App\Services\RoiCalculator;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AutomationStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $roi = app(RoiCalculator::class)->dashboardSummary();
        $hours = app(ModuleRegistry::class)->weeklyHoursSaved();

        return [
            Stat::make('Hours Saved', number_format($roi['hours_saved']))
                ->description('Tracked automation impact')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success'),
            Stat::make('Active Agents', VerticalAgent::query()->where('is_enabled', true)->count())
                ->description('Vertical AI workers online')
                ->color('primary'),
            Stat::make('Workflows Running', Workflow::query()->where('status', 'active')->count())
                ->description('Published industry flows')
                ->color('info'),
            Stat::make('ROI', $roi['roi_percent'].'%')
                ->description('Cost saved vs platform cost')
                ->color('warning'),
            Stat::make('Modules On', Module::query()->where('is_enabled', true)->count())
                ->description("{$hours} hrs/week estimated capacity")
                ->color('primary'),
            Stat::make('Tasks Automated', number_format($roi['tasks_automated']))
                ->description('$'.number_format($roi['cost_saved'], 0).' estimated savings')
                ->color('success'),
        ];
    }
}
