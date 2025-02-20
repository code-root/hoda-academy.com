<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customer_id = $this->route('customer'); // الحصول على معرف العميل من المسار

        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone' . ($customer_id ? ",$customer_id" : ''),

            'country_id' => 'required|exists:countries,id',
        ];
    }

}
