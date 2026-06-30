<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // lấy giá trị tham số id từ URL hiện tại
        $id = $this->route('id');

        return [
            'fullname' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                Rule::unique('users', 'username')->ignore($id, 'userid'),
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('users', 'email')->ignore($id, 'userid'),
            ],
            'password' => 'required|min:6',
            'phone' => [
                'required',
                'min:8',
                'max:20',
                'regex:/^[0-9]{8,20}$/',
                Rule::unique('users', 'phone')->ignore($id, 'userid'),
            ],
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:0,1,2',
            'birthday' => 'nullable|date_format:Y-m-d|before:today',
            'role' => 'required|in:0,1,2',
            'status' => 'required|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'email' => ':attribute không đúng định dạng.',
            'birthday.date_format' => ':attribute phải có định dạng YYYY-MM-DD.',
            'birthday.before' => ':attribute phải là ngày trong quá khứ.',
            'gender.in' => ':attribute không hợp lệ.',
            'phone.regex' => ':attribute chỉ được chứa chữ số và có từ 8 đến 20 ký tự.',
            'role.in' => ':attribute không hợp lệ.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Họ và tên',
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'gender' => 'Giới tính',
            'role' => 'Vai trò',
            'birthday' => 'Ngày sinh',
            'status' => 'Trạng thái',
        ];
    }
}
