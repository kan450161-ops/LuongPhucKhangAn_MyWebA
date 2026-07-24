<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    // chỉ định tên bảng trong database
    // (có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều)
    protected $table = 'brands';

    // chỉ định khóa chính
    // có thể bỏ qua khai báo $primaryKey nếu primary key là id
    protected $primaryKey = 'id';

    // các cột cho phép thêm/sửa dữ liệu hàng loạt
    protected $fillable = [
        'brandname',
        'slug',
        'description',
        'image',
        'status'
    ];

}
