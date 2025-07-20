<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'submission_limit' => 'required|integer|min:0',
            'form_limit' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'submission_limit.required' => 'Submission limit is required.',
            'form_limit.required' => 'Form limit is required.',
        ];
    }
}
