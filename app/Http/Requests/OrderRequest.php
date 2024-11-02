<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class OrderRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {

        return [
            'client_id' => 'required|exists:clients,id',
            'location_id' => 'required|exists:locations,id',   // Ensure location_id is valid
            'fuel_amount' => 'required|numeric|min:1',
            'delivery_address' => 'required|string|max:255',
            'status' => 'in:pending,completed,canceled',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'client_id.required' => 'Client is required.',
            'client_id.exists' => 'The selected client does not exist.',
            'location_id.required' => 'Location is required.',
            'location_id.exists' => 'The selected location does not exist.',
            'fuel_amount.required' => 'Fuel amount is required.',
            'fuel_amount.numeric' => 'Fuel amount must be a number.',
            'fuel_amount.min' => 'Fuel amount must be at least 1.',
            'delivery_address.required' => 'Delivery address is required.',
            'delivery_address.string' => 'Delivery address must be a valid string.',
            'delivery_address.max' => 'Delivery address cannot exceed 255 characters.',
            'status.in' => 'Status must be one of the following: pending, completed, or canceled.',
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
