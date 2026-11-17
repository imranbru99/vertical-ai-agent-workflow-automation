<?php

namespace App\Http\Controllers;

use App\Models\IndustryVertical;
use App\Models\Module;
use App\Models\VerticalAgent;
use App\Models\Workflow;
use App\Services\ModuleRegistry;
use App\Services\RoiCalculator;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function home(ModuleRegistry $modules, RoiCalculator $roi): View
    {
        return view('marketing.home', [
            'modules' => $modules->all(),
            'enabledCount' => $modules->enabled()->count(),
            'weeklyHours' => $modules->weeklyHoursSaved(),
            'roi' => $roi->dashboardSummary(),
            'verticals' => IndustryVertical::query()->where('is_active', true)->get(),
            'workflows' => Workflow::query()->where('is_published', true)->with('module')->take(6)->get(),
            'agents' => VerticalAgent::query()->where('is_enabled', true)->take(6)->get(),
        ]);
    }

    public function features(ModuleRegistry $modules): View
    {
        return view('marketing.features', [
            'modules' => $modules->all()->groupBy('category'),
        ]);
    }

    public function modules(ModuleRegistry $modules): View
    {
        return view('marketing.modules', [
            'modules' => $modules->all(),
        ]);
    }

    public function workflows(): View
    {
        return view('marketing.workflows', [
            'workflows' => Workflow::query()->with(['module', 'industryVertical', 'steps'])->where('is_published', true)->get(),
        ]);
    }

    public function agents(): View
    {
        return view('marketing.agents', [
            'agents' => VerticalAgent::query()->with('industryVertical')->where('is_enabled', true)->get(),
        ]);
    }

    public function pricing(ModuleRegistry $modules, RoiCalculator $roi): View
    {
        return view('marketing.pricing', [
            'weeklyHours' => $modules->weeklyHoursSaved(),
            'roi' => $roi->dashboardSummary(),
            'moduleCount' => Module::query()->count(),
        ]);
    }

    public function demo(): View
    {
        return view('marketing.demo', [
            'email' => config('vertical-ai.demo.email'),
            'password' => config('vertical-ai.demo.password'),
        ]);
    }
}
