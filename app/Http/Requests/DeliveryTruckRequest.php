<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class DeliveryTruckRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'license_plate' => 'required|string|unique:delivery_trucks,license_plate',
            'model' => 'required|string',
            'driver_name' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function messages() {
        return [
            'license_plate.required' => 'The license plate field is required.',
            'license_plate.string' => 'The license plate must be a valid string.',
            'license_plate.unique' => 'This license plate is already registered. Please provide a unique license plate.',

            'model.required' => 'The model field is required.',
            'model.string' => 'The model must be a valid string.',

            'driver_name.required' => 'The driver name field is required.',
            'driver_name.string' => 'The driver name must be a valid string.',

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
