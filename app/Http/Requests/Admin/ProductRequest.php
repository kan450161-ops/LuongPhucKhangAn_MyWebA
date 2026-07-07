<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
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

        // Lấy tham số id từ URL
        $id = $this->route('id');

        return [
          'productname' => [
            'required',
            'min:3',
            'max:100',
            Rule::unique('products', 'productname')->ignore($id, 'id'),
          ],
          'slug' => [
                'required',
                'min:5',
                'max:150',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('products', 'slug')->ignore($id, 'id'),
            ],
            'img' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
            ],
            // mảng
            'imgs' => [
                'nullable',
                'array',
            ],
            // từng phần tử trong file
            'imgs.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
            ],
            'cateid' => 'required',
            'brandid' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'numeric' => ':attribute phải là số.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'img.image' => ':attribute phải là hình ảnh.',
            'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'img.max' => ':attribute không được vượt quá 200 KB.',

            'image' => ':attribute phải là hình ảnh.',
            'mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'image.max' => ':attribute không được vượt quá 200 KB.',
            'images.*.max' => ':attribute không được vượt quá 200 KB.',
        ];
    }
    public function attributes(): array
    {
    return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn (Slug)',
            'cateid' => 'Loại sản phẩm',
            'brandid' => 'Thương hiệu',
            'price' => 'Giá',
            'status' => 'Trạng thái',
            'img' => 'Hình ảnh'
        ];
    }
}