<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthProviders extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider_name',
        'token',
        'refresh_token',
        'email',
        'avatar',
        'name',
        'nickname',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
