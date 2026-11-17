@extends('layouts.marketing')
@section('title', 'Demo Access')
@section('content')
<section class="hero">
    <div class="eyebrow">Try it now</div>
    <h1>Demo user ready for Filament admin</h1>
    <p>Explore modules, workflows, agents, pipelines, and ROI widgets with a seeded multi-role environment.</p>
</section>
<section class="section">
    <div class="card" style="max-width:520px">
        <h3>Demo credentials</h3>
        <p style="margin-top:.75rem"><strong>URL:</strong> <a href="/admin">/admin</a></p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
        <p style="margin-top:1rem">Also seeded: Super Admin, Admin, Manager, Staff, and Client accounts (see README).</p>
        <div class="cta-row" style="margin-top:1.2rem">
            <a class="btn" href="/admin/login">Open Admin Panel</a>
        </div>
    </div>
</section>
@endsection
