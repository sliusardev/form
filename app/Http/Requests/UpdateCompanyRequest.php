<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                function ($attribute, $value, $fail) {
                    // Custom validation to check uniqueness properly
                    $exists = Company::query()->where('slug', $value)
                        ->where('user_id', '!=', auth()->user()->id)
                        ->exists();

                    if ($exists) {
                        $fail('The slug has already been taken.');
                    }
                }
            ],
            'data' => 'nullable|array',
        ];
    }
}
