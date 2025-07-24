<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
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
            // Basic validation rules for common form fields
            // These can be customized based on the specific form requirements
            '*' => 'sometimes|nullable',
            '*.email' => 'sometimes|nullable|email',
            '*.url' => 'sometimes|nullable|url',
            '*.phone' => 'sometimes|nullable|string|max:20',
            '*.file' => 'sometimes|nullable|file|max:10240', // 10MB max file size
            '*.image' => 'sometimes|nullable|image|max:5120', // 5MB max image size
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check for potentially malicious content in any string values
            $this->validateForMaliciousContent($validator, $this->all());
        });
    }

    /**
     * Recursively check for potentially malicious content in form data
     *
     * @param \Illuminate\Validation\Validator $validator
     * @param array $data
     * @param string $prefix
     * @return void
     */
    protected function validateForMaliciousContent($validator, array $data, string $prefix = '')
    {
        foreach ($data as $key => $value) {
            $fieldName = $prefix ? "{$prefix}.{$key}" : $key;

            if (is_array($value)) {
                $this->validateForMaliciousContent($validator, $value, $fieldName);
            } elseif (is_string($value)) {
                // Check for potentially malicious scripts
                if (preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $value)) {
                    $validator->errors()->add($fieldName, 'The field contains potentially malicious content.');
                }

                // Check for other potentially dangerous HTML tags
                if (preg_match('/<\s*iframe|<\s*object|<\s*embed|javascript:|data:|vbscript:|on[a-z]+\s*=|<\s*svg/i', $value)) {
                    $validator->errors()->add($fieldName, 'The field contains potentially malicious content.');
                }
            }
        }
    }
}
