<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Sử dụng Eloquent + eager loading để lấy bài viết cùng thông tin user liên quan
        $list = Post::select(
            'id',
            'title',
            'slug',
            'content',
            'image',
            'status',
            'user_id'
        )
        ->with(['user' => function($query) {
            $query->select('userid', 'username');
        }])
        ->orderBy('title', 'asc')
        ->paginate($limit);

        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('userid','fullname')->orderBy('fullname')->get();
        return view('admin.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:200',
        //     'slug' => 'required|string|max:255|unique:posts,slug',
        //     'content' => 'required|string',
        //     'user_id' => 'nullable|integer|exists:users,userid'
        // ]);

        // Xác định user_id: ưu tiên user đang đăng nhập, sau đó input, sau đó fallback lấy user đầu tiên
        if (auth()->check()) {
            $userId = auth()->user()->userid ?? auth()->id();
        } else {
            $userId = $request->input('user_id') ?? User::value('userid');
        }

        // Nếu vẫn null, mặc định 1 (nếu có)
        if (empty($userId)) {
            $userId = 1;
        }

        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'user_id' => $userId,
            'image' => $request->input('image'),
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('admin.posts.index');
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
