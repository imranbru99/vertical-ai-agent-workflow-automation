@extends('layouts.marketing')

@section('title', 'Vertical AI Agent')
@section('meta_description', 'Enterprise vertical AI agent platform for industry-specific workflow automation, modular ops, and measurable time savings across sales, ops, and support.')

@section('content')
<section class="hero">
    <div class="eyebrow">Cross-industry automation</div>
    <h1>Vertical AI agents that run your workflows — and prove the hours you save.</h1>
    <p>Turn sales, ops, and support into modular automation. Enable only the modules your business needs. Measure ROI in hours, tasks, and dollars — not vanity dashboards.</p>
    <div class="cta-row">
        <a class="btn" href="{{ route('demo') }}">Launch Demo</a>
        <a class="btn secondary" href="{{ route('modules') }}">Explore Modules</a>
    </div>
</section>

<section class="section">
    <div class="grid">
        <div class="card"><div class="kpi">{{ number_format($roi['hours_saved']) }}h</div><p>Hours saved tracked in demo metrics</p></div>
        <div class="card"><div class="kpi">{{ $enabledCount }}</div><p>Modules enabled right now</p></div>
        <div class="card"><div class="kpi">{{ $weeklyHours }}h</div><p>Estimated weekly capacity when modules stay on</p></div>
        <div class="card"><div class="kpi">{{ $roi['roi_percent'] }}%</div><p>ROI vs platform cost model</p></div>
    </div>
</section>

<section class="section">
    <div class="eyebrow">Industry verticals</div>
    <h2>Playbooks for every operating model</h2>
    <div class="grid" style="margin-top:1rem">
        @foreach($verticals as $vertical)
            <div class="card">
                <h3>{{ $vertical->name }}</h3>
                <p>{{ $vertical->description }} Typical ROI {{ $vertical->typical_roi_percent }}%.</p>
            </div>
        @endforeach
    </div>
</section>

<section class="section">
    <div class="eyebrow">Published workflows</div>
    <h2>From intake to report — automated</h2>
    <div class="grid" style="margin-top:1rem">
        @foreach($workflows as $workflow)
            <div class="card">
                <span class="pill">{{ $workflow->module?->name ?? 'Module' }}</span>
                <h3 style="margin-top:.6rem">{{ $workflow->name }}</h3>
                <p>{{ $workflow->description }} Saves ~{{ (int) $workflow->avg_minutes_saved }} minutes per run.</p>
            </div>
        @endforeach
    </div>
</section>

<section class="section">
    <div class="eyebrow">Agents</div>
    <h2>Specialists that never sleep</h2>
    <div class="grid" style="margin-top:1rem">
        @foreach($agents as $agent)
            <div class="card">
                <h3>{{ $agent->name }}</h3>
                <p>{{ ucfirst($agent->specialty) }} · {{ $agent->tasks_completed }} tasks · {{ $agent->success_rate }}% success</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
