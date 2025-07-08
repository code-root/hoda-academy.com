<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255|min:3',
            'title_en' => 'required|string|max:255|min:3',
            'meta_description_ar' => 'required|string|max:500',
            'meta_description_en' => 'required|string|max:500',
            'overview_ar' => 'nullable|string',
            'overview_en' => 'nullable|string',
            'tag_ar' => 'nullable|string|max:255',
            'tag_en' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
        ];

        // Add photo validation only for create or if photo is provided in update
        if ($this->isMethod('post') || $this->hasFile('photo')) {
            $rules['photo'] = 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title_ar.required' => __('admin.Title is required'),
            'title_ar.string' => __('admin.Title must be a string'),
            'title_ar.max' => __('admin.Title cannot exceed 255 characters'),
            'title_ar.min' => __('admin.Title must be at least 3 characters'),
            'title_en.required' => __('admin.Title is required'),
            'title_en.string' => __('admin.Title must be a string'),
            'title_en.max' => __('admin.Title cannot exceed 255 characters'),
            'title_en.min' => __('admin.Title must be at least 3 characters'),
            'meta_description_ar.required' => __('admin.Meta description is required'),
            'meta_description_ar.max' => __('admin.Meta description cannot exceed 500 characters'),
            'meta_description_en.required' => __('admin.Meta description is required'),
            'meta_description_en.max' => __('admin.Meta description cannot exceed 500 characters'),
            'tag_ar.max' => __('admin.Tags cannot exceed 255 characters'),
            'tag_en.max' => __('admin.Tags cannot exceed 255 characters'),
            'user_id.required' => __('admin.User is required'),
            'user_id.exists' => __('admin.Selected user does not exist'),
            'photo.image' => __('admin.Photo must be an image'),
            'photo.mimes' => __('admin.Photo must be a valid image format'),
            'photo.max' => __('admin.Photo size cannot exceed 2MB'),
        ];
    }
}
