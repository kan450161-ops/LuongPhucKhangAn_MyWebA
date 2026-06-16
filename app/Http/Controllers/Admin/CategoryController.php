<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
    //    $list = DB::table('categories')
    //     ->select('cateid','catename','slug','image','status') //Chỉ lấy các cột cần thiết
    //     ->where('status',1) //Chỉ lấy các loại sản phẩm đang hoạt động
    //     ->orderBy('catename') // Sắp xếp dữ liệu theo cột catename theo thứ tự tăng dần
    //     ->get(); //Lấy tất cả dữ liệu thỏa mãn điều kiện
    // == Query Builder ==

        $list = Category::select('cateid','catename','slug','image','status') //Chỉ lấy các cột cần thiết
            ->orderBy('catename') // Sắp xếp dữ liệu theo cột catename theo thứ tự tăng dần
            ->paginate($limit);


        return view('admin.categories.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //query builder
        // DB::table('categories')->insert([
        //     'catename' => $request->catename,
        //     'slug' => $request->slug
        // ]);
        // Eloquent ORM
        Category::create([
            'catename' => $request->catename,
            'slug' => $request->slug
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show Category with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return"Edit Category with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('categories') //Truy cập vào bảng categories
            ->where('cateid', $id)
            ->update([
                'catename' => $request->catename,
                'slug' => $request->slug
            ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        return redirect()->route('admin.categories.index');
    }
   
}
