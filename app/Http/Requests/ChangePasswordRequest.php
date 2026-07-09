<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required',

            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => ':attribute không được để trống.',

            'password.required' => ':attribute không được để trống.',
            'password.min' => ':attribute phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];
    }

    public function attributes(): array
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'password' => 'Mật khẩu mới',
        ];
    }
}