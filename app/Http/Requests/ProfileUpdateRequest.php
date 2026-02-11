<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],

            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],

            'password' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->mixedCase()   // حداقل یک حرف بزرگ و یک حرف کوچک
                    ->numbers()     // حداقل یک عدد
                    ->symbols(),    // حداقل یک کاراکتر خاص
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام الزامی است.',
            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً استفاده شده است.',

            'password.confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.mixedCase' => 'رمز عبور باید شامل حداقل یک حرف بزرگ و یک حرف کوچک باشد.',
            'password.numbers' => 'رمز عبور باید شامل حداقل یک عدد باشد.',
            'password.symbols' => 'رمز عبور باید شامل حداقل یک کاراکتر خاص باشد.',
        ];
    }
}
