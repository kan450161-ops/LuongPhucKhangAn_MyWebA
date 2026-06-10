<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    // chỉ định tên bảng trong database
    // (có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều)
    protected $table = 'products';

    // chỉ định khóa chính
    // có thể bỏ qua khai báo $primaryKey nếu primary key là id
    protected $primaryKey = 'id';

    // các cột cho phép thêm/sửa dữ liệu hàng loạt
    protected $fillable = [
        'productname',
        'slug',
        'description',
        'image',
        'status'
    ];

    //cấu hình quan hệ với bảng categories
    public function category()
    {
        //products.cateid = categories.cateid
        return $this->belongsTo(Category::class, 'cateid','cateid');
    }

    //cấu hình quan hệ với brand
    public function brand()
    {
        //products.brandid = brands.id
        return $this->belongsTo(Brand::class, 'brandid','id');
    }
}