<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'hash',
        'data',
        'submission_limit',
        'form_limit',
        'is_enabled',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'hash' => 'string',
            'submission_limit' => 'integer',
            'form_limit' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class, 'company_id', 'id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'company_id', 'id');
    }

    public function scopeEnabled(Builder $query): void
    {
        $query->where('is_enabled', true);
    }
}
