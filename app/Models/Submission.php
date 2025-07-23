<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $fillable = [
        'company_id',
        'form_id',
        'payload',
        'status',
        'ip_address',
        'hash',
        'method',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    /**
     * Get the payload attribute.
     *
     * @param  mixed  $value
     * @return array
     */
    public function formated(): array
    {
        $value = $this->attributes['payload'];
        $payload = is_array($value) ? $value : json_decode($value, true);

        // Handle special payload format where the payload is a JSON object with a single key
        // that is itself a JSON string, and the value is null
        if (is_array($payload) && count($payload) === 1) {
            $key = array_key_first($payload);
            $value = $payload[$key];

            // Check if the key is a JSON string and the value is null
            if (is_string($key) && $value === null && $this->isJson($key)) {
                return json_decode($key, true);
            }
        }

        return $payload;
    }

    /**
     * Check if a string is valid JSON.
     *
     * @param  string  $string
     * @return bool
     */
    private function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }
}
