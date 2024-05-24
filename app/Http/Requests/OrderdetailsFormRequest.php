<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderdetailsFormRequest extends FormRequest
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
            'product_name' => $isRequired.'string',
			'product_description' => $isRequired.'string',
			'soldePrice' => $isRequired.'string',
			'regularPrice' => $isRequired.'string',
			'quantity' => $isRequired.'string',
			'taxe' => $isRequired.'string',
			'sub_total_ht' => $isRequired.'string',
			'sub_total_ttc' => $isRequired.'string'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            
        ]);
    }
}