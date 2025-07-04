<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'hash',
        'data'
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'hash' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
