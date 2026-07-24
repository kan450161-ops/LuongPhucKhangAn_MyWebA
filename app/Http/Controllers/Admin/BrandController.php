<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        try {
            // upload hình ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                .'-'.time()
                .'.'.$file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/brands
                $file->storeAs('brands', $fileName, 'public');
            }
            Brand::create([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'sort_order' => $request->sort_order ?? 0,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm Thương Hiệu thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Thêm Thương Hiệu thất bại! Lỗi: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Show Brand with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $brands = Brand::find($id);
        $brands = Brand::find($id, ['*']); 

        return view('admin.brands.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        try {

            // $brands = Brand::find($id);
            $brands = Brand::find($id, ['*']);

            // if (!$brands) {
            //     return redirect()
            //         ->route('admin.brands.index')
            //         ->with('error', 'Sản phẩm không tồn tại');
            // }

            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $brands->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('brands/'.$brands->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)

                .'-'.time()
                .'.'.$file->extension();
                $file->storeAs('brands', $fileName, 'public');
            }

            // thực hiện cập nhật sản phẩm
            $brands->update([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'sort_order' => $request->sort_order,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName,
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
        try {
            Brand::findOrFail($id)->delete();

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Xóa thương hiệu thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    // hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
    public function trash($limit = 10)
    {
        $list = Brand::onlyTrashed()
            ->select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.trash', compact('list'));
    }

    // khôi phục dữ liệu đã xóa
    public function restore($id)
    {
        try {
            Brand::onlyTrashed()->findOrFail($id)->restore();

            return redirect()
                ->route('admin.brands.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục thất bại.');
        }
    }

    // xóa vĩnh viễn
    public function forceDelete($id)
    {
        try {
            Brand::onlyTrashed()->findOrFail($id)->forceDelete();

            return redirect()
                ->route('admin.brands.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa thất bại.');
        }
    }
}
