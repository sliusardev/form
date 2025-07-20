<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'data'
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array'
        ];
    }
}
