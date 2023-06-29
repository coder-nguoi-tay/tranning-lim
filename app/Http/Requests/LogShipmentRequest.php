<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogShipmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'shipment_id' => 'required|numeric',
            'status' => 'required|numeric',
            'post_offices_id' => 'required|numeric',
            'shiper_id' => 'required|numeric',
        ];
    }
}
