<?php

namespace App\Models;

use App\Enums\WorkflowStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workflow extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'industry_vertical_id',
        'module_id',
        'owner_id',
        'status',
        'trigger_type',
        'description',
        'definition',
        'steps_count',
        'runs_count',
        'avg_minutes_saved',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'status' => WorkflowStatus::class,
            'definition' => 'array',
            'is_published' => 'boolean',
            'avg_minutes_saved' => 'decimal:2',
        ];
    }

    public function industryVertical(): BelongsTo
    {
        return $this->belongsTo(IndustryVertical::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(WorkflowStep::class)->orderBy('position');
    }

    public function runs(): HasMany
    {
        return $this->hasMany(AutomationRun::class);
    }

    public function agents(): HasMany
    {
        return $this->hasMany(VerticalAgent::class);
    }
}
