<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|unique:companies,name',
            'domain' => 'required|string|unique:companies,domain',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a valid string.',
            'name.unique' => 'The company name is already in use. Please choose a different name.',

            'domain.required' => 'The domain field is required.',
            'domain.string' => 'The domain must be a valid string.',
            'domain.unique' => 'The domain is already registered. Please choose a different domain.',
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
