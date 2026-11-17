@extends('layouts.marketing')
@section('title', 'Pricing & ROI')
@section('content')
<section class="hero">
    <div class="eyebrow">Business case</div>
    <h1>Price against hours returned — not seats alone</h1>
    <p>With {{ $moduleCount }} modules available and ~{{ $weeklyHours }} estimated hours/week when enabled, Vertical AI Agent pays for itself through automation density.</p>
</section>
<section class="section">
    <div class="grid">
        <div class="card">
            <h3>Starter Vertical</h3>
            <div class="kpi">$499<span style="font-size:1rem;color:var(--muted)">/mo</span></div>
            <p>Core sales + ops modules, 3 agents, ROI dashboard, demo-ready seed.</p>
        </div>
        <div class="card">
            <h3>Growth Ops</h3>
            <div class="kpi">$1,200<span style="font-size:1rem;color:var(--muted)">/mo</span></div>
            <p>All modules toggleable, pipelines, multilingual PDF, AI catalog, attendance bridge.</p>
        </div>
        <div class="card">
            <h3>Enterprise Fabric</h3>
            <div class="kpi">Custom</div>
            <p>Private models, SSO, multi-tenant module packs, SLA automation & advisory.</p>
        </div>
    </div>
    <div class="card" style="margin-top:1rem">
        <h3>Live demo ROI snapshot</h3>
        <p>{{ number_format($roi['hours_saved']) }} hours · {{ number_format($roi['tasks_automated']) }} tasks · ${{ number_format($roi['cost_saved'], 0) }} estimated · {{ $roi['roi_percent'] }}% ROI</p>
    </div>
</section>
@endsection
