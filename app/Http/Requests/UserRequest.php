<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

    // $user = $this->route('user') ?? $this->route('user2');


        $user = $this->route('teacher') ?? $this->route('user') ?? $this->route('user2') ?? 0; // مثلا 0 في حالة عدم وجود المعامل


//    dd( $this);
    return [
        'name_ar' => 'required|string|max:255',
        'overview_ar' => 'nullable|string ',
        'name_en' => 'required|string|max:255',
        'overview_en' => 'nullable|string ',
        'phone' => [
            'required',
            'string',
            'regex:/^01[0-9]{9}$/', // تحقق من أن الرقم يبدأ بـ 01 ويتكون من 11 رقمًا
            Rule::unique('users', 'phone')->ignore($user),
        ],
        'email' => [
            'required',
            'string',
            'email',
            Rule::unique('users', 'email')->ignore($user),
        ],
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
         'title_ar1.*' => 'string',
         'description_ar1.*' => 'string',
         'title_en1.*' => 'string',

        'description_en1.*' => 'string',
    ];
}
}
