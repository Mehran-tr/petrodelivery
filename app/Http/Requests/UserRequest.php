<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,operator,driver',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different email address.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters long.',

            'role.required' => 'The role field is required.',
            'role.in' => 'The role must be one of the following: admin, operator, or driver.',

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
