<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $list = DB::table('posts')
        //     ->select('id','title','slug','content','image','status') //Chỉ lấy các cột cần thiết
        //     ->where('status',1) //Chỉ lấy các loại sản phẩm đang hoạt động
        //     ->orderBy('title') // Sắp xếp dữ liệu theo cột title theo thứ tự tăng dần
        //     ->get(); //Lấy tất cả dữ liệu thỏa mãn
        
        $list = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.userid')
            ->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.content',
                'posts.image',
                'posts.status',
                'users.username'
            )
            ->orderBy('posts.title', 'asc')
            ->get();
        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return"Create Post";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return"Store Post";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show Post with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return"Edit Post with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return"Update Post with id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete Post with id: $id";
    }
}
