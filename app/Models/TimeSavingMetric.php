<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSavingMetric extends Model
{
    protected $fillable = [
        'module_id',
        'workflow_id',
        'industry_vertical_id',
        'metric_date',
        'hours_saved',
        'tasks_automated',
        'estimated_cost_saved',
        'department',
    ];

    protected function casts(): array
    {
        return [
            'metric_date' => 'date',
            'estimated_cost_saved' => 'decimal:2',
        ];
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    public function industryVertical(): BelongsTo
    {
        return $this->belongsTo(IndustryVertical::class);
    }
}
