<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        // Lấy giá trị tham số id từ URL hiện tại
        $id = $this->route('id');

        return [
            'title' => [
                'required',
                'min:3',
                'max:200',
                Rule::unique('posts', 'title')->ignore($id, 'id'),
            ],

            'slug' => [
                'required',
                'min:3',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('posts', 'slug')->ignore($id, 'id'),
            ],

            'content' => [
                'required',
                'min:10',
            ],

            'user_id' => [
                'required',
            ],

            'status' => [
                'required',
                'in:0,1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'user_id' => 'Người đăng',
            'status' => 'Trạng thái',
        ];
    }
}