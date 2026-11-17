@extends('layouts.marketing')
@section('title', 'Modules On/Off')
@section('content')
<section class="hero">
    <div class="eyebrow">Modular by design</div>
    <h1>Run only the modules your business needs</h1>
    <p>Core modules stay protected. Optional modules can be toggled per tenant so sales-heavy teams, ops centers, and support orgs each get a lean footprint.</p>
</section>
<section class="section">
    <table>
        <thead>
        <tr>
            <th>Module</th>
            <th>Category</th>
            <th>Status</th>
            <th>Weekly hours</th>
            <th>Core</th>
        </tr>
        </thead>
        <tbody>
        @foreach($modules as $module)
            <tr>
                <td><strong>{{ $module->name }}</strong><br><small>{{ $module->key }}</small></td>
                <td>{{ $module->category }}</td>
                <td><span class="pill {{ $module->is_enabled ? '' : 'off' }}">{{ $module->is_enabled ? 'ON' : 'OFF' }}</span></td>
                <td>{{ $module->estimated_hours_saved_weekly }}h</td>
                <td>{{ $module->is_core ? 'Yes' : 'No' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
