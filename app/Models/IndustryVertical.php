<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndustryVertical extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'accent_color',
        'is_active',
        'default_modules',
        'typical_roi_percent',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'default_modules' => 'array',
            'typical_roi_percent' => 'integer',
        ];
    }

    public function workflows(): HasMany
    {
        return $this->hasMany(Workflow::class);
    }

    public function agents(): HasMany
    {
        return $this->hasMany(VerticalAgent::class);
    }

    public function pipelines(): HasMany
    {
        return $this->hasMany(Pipeline::class);
    }
}
