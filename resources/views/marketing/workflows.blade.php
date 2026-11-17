@extends('layouts.marketing')
@section('title', 'Workflows')
@section('content')
<section class="hero">
    <div class="eyebrow">Workflow automation</div>
    <h1>Industry workflows with measurable minutes saved</h1>
    <p>Each workflow is a sequenced graph: Intake → Qualify → Route → Automate → Report. Dispatch from Filament or APIs when the owning module is enabled.</p>
</section>
<section class="section">
    <div class="grid">
        @foreach($workflows as $workflow)
            <div class="card">
                <span class="pill">{{ $workflow->status->value }}</span>
                <h3 style="margin-top:.55rem">{{ $workflow->name }}</h3>
                <p>{{ $workflow->industryVertical?->name }} · {{ $workflow->module?->name }}</p>
                <p style="margin-top:.5rem">Steps: {{ $workflow->steps->pluck('name')->join(' → ') }}</p>
                <p><strong>{{ (int) $workflow->avg_minutes_saved }} min</strong> saved / run · {{ $workflow->runs_count }} runs</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
