@extends('layouts.marketing')
@section('title', 'Features')
@section('content')
<section class="hero">
    <div class="eyebrow">Complete feature set</div>
    <h1>Everything a world-class automation business needs</h1>
    <p>Multi-role access, module toggles, vertical agents, pipelines, ROI analytics, multilingual PDF reporting, AI catalog ingestion, attendance bridges, and Filament admin — in one Laravel platform.</p>
</section>
@foreach($modules as $category => $items)
<section class="section">
    <h2>{{ ucfirst($category) }}</h2>
    <div class="grid" style="margin-top:1rem">
        @foreach($items as $module)
            <div class="card">
                <span class="pill {{ $module->is_enabled ? '' : 'off' }}">{{ $module->is_enabled ? 'Enabled' : 'Disabled' }}</span>
                <h3 style="margin-top:.55rem">{{ $module->name }}</h3>
                <p>{{ $module->description }}</p>
            </div>
        @endforeach
    </div>
</section>
@endforeach
@endsection
