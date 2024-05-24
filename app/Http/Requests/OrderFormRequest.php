<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
        $isRequired = request()->isMethod("POST") ?"required|": "";
        return [
            //
            'clientName' => $isRequired.'string',
			'billing_address' => $isRequired.'string',
			'shipping_address' => $isRequired.'string',
			'quantity' => $isRequired.'string',
			'taxe' => $isRequired.'string',
			'order_cost' => $isRequired.'string',
			'order_cost_ttc' => $isRequired.'string',
			'isPaid' => $isRequired.'in:true,false|nullable',
			'carrier_name' => $isRequired.'string',
			'carrier_price' => $isRequired.'string',
			'paymeny_method' => $isRequired.'string',
			'stripe_payment_intent' => $isRequired.'string'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'isPaid' => $this->input('isPaid') ? 'true' : 'false',
			
        ]);
    }
}