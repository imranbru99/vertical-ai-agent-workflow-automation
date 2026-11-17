<?php

namespace App\Models;

use App\Enums\AgentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VerticalAgent extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'specialty',
        'industry_vertical_id',
        'workflow_id',
        'status',
        'model_provider',
        'model_name',
        'system_prompt',
        'capabilities',
        'tasks_completed',
        'success_rate',
        'is_enabled',
    ];

    protected function casts(): array
    {
        return [
            'status' => AgentStatus::class,
            'capabilities' => 'array',
            'success_rate' => 'decimal:2',
            'is_enabled' => 'boolean',
        ];
    }

    public function industryVertical(): BelongsTo
    {
        return $this->belongsTo(IndustryVertical::class);
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    public function runs(): HasMany
    {
        return $this->hasMany(AutomationRun::class);
    }
}
