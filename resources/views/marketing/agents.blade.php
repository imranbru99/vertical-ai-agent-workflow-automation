@extends('layouts.marketing')
@section('title', 'Vertical Agents')
@section('content')
<section class="hero">
    <div class="eyebrow">AI workforce</div>
    <h1>Vertical agents specialized for sales, ops, support, finance & HR</h1>
    <p>Agents bind to workflows, providers, and industry verticals. Track success rate, completed tasks, and model routing via laravel-ai-hub.</p>
</section>
<section class="section">
    <div class="grid">
        @foreach($agents as $agent)
            <div class="card">
                <h3>{{ $agent->name }}</h3>
                <p>{{ $agent->industryVertical?->name }} · {{ $agent->model_provider }}/{{ $agent->model_name }}</p>
                <p style="margin-top:.5rem">Status: {{ $agent->status->value }} · Success {{ $agent->success_rate }}% · {{ $agent->tasks_completed }} tasks</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
