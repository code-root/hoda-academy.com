<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateingRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'review' => 'nullable|string',
            'rate' => 'required|integer|min:1|max:5',
        ];

        // Add photo validation only for create or if photo is provided in update
        if ($this->isMethod('post') || $this->hasFile('photo')) {
            $rules['photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('admin.Name is required'),
            'name.string' => __('admin.Name must be a string'),
            'name.max' => __('admin.Name cannot exceed 255 characters'),
            'rate.required' => __('admin.Rating is required'),
            'rate.integer' => __('admin.Rating must be a number'),
            'rate.min' => __('admin.Rating must be at least 1'),
            'rate.max' => __('admin.Rating cannot exceed 5'),
            'photo.image' => __('admin.Photo must be an image'),
            'photo.mimes' => __('admin.Photo must be a valid image format'),
            'photo.max' => __('admin.Photo size cannot exceed 2MB'),
        ];
    }
}
