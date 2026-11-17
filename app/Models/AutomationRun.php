<?php

namespace App\Models;

use App\Enums\AutomationRunStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutomationRun extends Model
{
    protected $fillable = [
        'workflow_id',
        'vertical_agent_id',
        'triggered_by',
        'status',
        'started_at',
        'finished_at',
        'duration_seconds',
        'minutes_saved',
        'input_payload',
        'output_payload',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'status' => AutomationRunStatus::class,
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'input_payload' => 'array',
            'output_payload' => 'array',
        ];
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(VerticalAgent::class, 'vertical_agent_id');
    }

    public function triggeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'triggered_by');
    }
}
