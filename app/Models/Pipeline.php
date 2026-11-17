<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pipeline extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'industry_vertical_id',
        'stage',
        'description',
        'stages',
        'items_in_flight',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'stages' => 'array',
            'is_active' => 'boolean',
            'items_in_flight' => 'integer',
        ];
    }

    public function industryVertical(): BelongsTo
    {
        return $this->belongsTo(IndustryVertical::class);
    }
}
