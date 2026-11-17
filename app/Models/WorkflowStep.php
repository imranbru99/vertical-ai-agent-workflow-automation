<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkflowStep extends Model
{
    protected $fillable = [
        'workflow_id',
        'name',
        'step_type',
        'position',
        'config',
        'estimated_seconds',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'array',
            'position' => 'integer',
            'estimated_seconds' => 'integer',
        ];
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }
}
