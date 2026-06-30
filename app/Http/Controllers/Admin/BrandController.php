<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('brands')
        //     ->select('id', 'brandname', 'slug', 'image', 'status')
        //     ->orderBy('brandname')
        //     ->get();
        $list = Brand::select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {   
        // query builder
        // DB::table('brands')->insert([
        //     'brandname' => $request->brandname,
        //     'slug' => $request->slug
        // ]);
        // Eloquent ORM
        // Brand::create([
        //     'brandname' => $request->brandname,
        //     'slug' => $request->slug
        // ]);

        try{
        Brand::create([
            'brandname' => $request->brandname,
            'slug' => $request->slug,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'description' => $request->description
        ]);
        return redirect()
        ->route('admin.brands.index')
        ->with('success', 'Thêm Thương Hiệu thành công!');
        }catch(\Exception $e){
            return back()
            ->withInput()
            ->with('error', 'Thêm Thương Hiệu thất bại! Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show Brand with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brands = Brand::find($id);
        return view('admin.brands.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        try {

            $brands = Brand::find($id);

            if (!$brands) {
                return redirect()
                    ->route('admin.brands.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // thực hiện cập nhật sản phẩm
            $brands->update([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'sort_order' => $request->sort_order,
                'status' => $request->status,
                'description' => $request->description
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Cập nhật Danh mục thành công');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete Brand with id: $id";
    }
}
