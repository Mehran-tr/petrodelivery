<?php

// app/Http/Requests/LocationRequest.php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationRequest extends FormRequest {
    public function authorize() {
        return true; // Allow all authorized users
    }

    public function rules() {
        return [
            'client_id' => 'required|exists:clients,id', // Ensure client exists
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
        ];
    }

    public function messages() {
        return [
            'client_id.required' => 'Client ID is required.',
            'client_id.exists' => 'The selected client does not exist.',
            'address_line1.required' => 'Address line 1 is required.',
            'city.required' => 'City is required.',
            'country.required' => 'Country is required.',
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

