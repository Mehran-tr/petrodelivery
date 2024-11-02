<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',

            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a valid string.',

            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone must be a valid string.',

            'company_id.required' => 'The company field is required.',
            'company_id.exists' => 'The selected company does not exist in the database.',
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
