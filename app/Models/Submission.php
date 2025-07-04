<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Submission extends Model
{
    protected $fillable = [
        'company_id',
        'form_id',
        'payload',
        'status',
        'ip_address',
        'hash',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }
}
