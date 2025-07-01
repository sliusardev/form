<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

class Form extends Model
{
    protected $fillable = [
        'company_id',
        'project_id',
        'title',
        'description',
        'is_enabled',
        'send_notify',
        'hash',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'send_notify' => 'boolean',
        'hash' => 'string',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'form_id', 'id');
    }

    public function scopeEnabled(Builder $query): void
    {
        $query->where('is_enabled', true);
    }

    public function formUrl(): string
    {
        return route('forms.store-submission', $this->hash);
    }
}
