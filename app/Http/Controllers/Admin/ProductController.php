<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $list = DB::table('products')
        //     ->select('id','productname','slug','image','status') //Chỉ lấy các cột cần thiết
        //     ->where('status',1) //Chỉ lấy các loại sản phẩm đang hoạt động
        //     ->orderBy('productname') // Sắp xếp dữ liệu theo cột productname theo thứ tự tăng dần
        //     ->get(); //Lấy tất cả dữ liệu thỏa mãn điều kiện
       
       $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
            ->select(
                'products.id',
                'products.productname',
                'products.price',
                'products.slug',
                'products.image',
                'products.status',
                'categories.catename',
                'brands.brandname'
            )
            ->orderBy('products.productname', 'asc')
            ->get();

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return"Create Product";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return"Store Product";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show Product with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return"Edit Product with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return"Update Product with id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete Product with id: $id";
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }

    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}
