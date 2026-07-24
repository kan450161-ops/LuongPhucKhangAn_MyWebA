<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    // chỉ định tên bảng trong database
    protected $table = 'posts';

    // chỉ định khóa chính
    protected $primaryKey = 'id';

    // các cột cho phép thêm/sửa dữ liệu hàng loạt
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
        'user_id',
    ];

    /**
     * Post thuộc về User (người đăng)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

}