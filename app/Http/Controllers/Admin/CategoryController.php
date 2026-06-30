<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        // Category::create([
        //     'catename' => $request->catename,
        //     'slug' => $request->slug,
        //     ''
        // ]);
        // Thực hiện Validation dữ liệu
        // Tự động lưu lỗi vào $errors và chuyển về trang trước nếu Validation thất bại
        $request->validate(
        // Parram 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        [
        'catename' => 'required|min:3|max:100|unique:categories,catename',
        'slug' => [
        'required',
        'min:5',
        'max:150',
        'unique:categories,slug',
        'regex:/^[a-z0-9-]+$/'
        ],
        'status' => 'required|in:0,1'
        ],
        // Parram 2: Messages - tùy chỉnh nội dung thông báo lỗi.
        [
        'required' => ':attribute không được để trống.',
        'min' => ':attribute phải từ :min ký tự trở lên.',
        'max' => ':attribute không vượt quá :max ký tự.',
        'unique' => ':attribute đã tồn tại.',
        'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        'status.in' => ':attribute không hợp lệ.'
        ],
        // Parram 3: Attributes- tên hiển thị của các trường
        [
        'catename' => 'Tên loại',
        'slug' => 'Đường dẫn (Slug)',
        'status' => 'Trạng thái'
        ]
        );
        try{
        Category::create([
            'catename' => $request->catename,
            'slug' => $request->slug,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'description' => $request->description
        ]);
        return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Thêm Danh mục thành công!');
        }catch(\Exception $e){
            return back()
            ->withInput()
            ->with('error', 'Thêm Danh mục thất bại! Lỗi: ' . $e->getMessage());
        }
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
        $categories = Category::find($id);
        return view('admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate dữ liệu
        $request->validate(
        // Param 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        [
            'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id.',cateid',
            'slug' => [
            'required',
            'min:5',
            'max:150',
            'regex:/^[a-z0-9-]+$/',
            Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
            ],
            'status' => 'required|in:0,1'
        ],
        // Param 2: Messages - tùy chỉnh nội dung thông báo lỗi
        [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.'
        ],
        // Param 3: Attributes - tên hiển thị của các trường
        [
            'catename' => 'Tên loại',
            'slug' => 'Đường dẫn (Slug)',
            'status' => 'Trạng thái'
        ]
        );
        try {

            $categories = Category::find($id);

            if (!$categories) {
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // thực hiện cập nhật sản phẩm
            $categories->update([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'sort_order' => $request->sort_order,
                'status' => $request->status,
                'description' => $request->description
            ]);

            return redirect()
                ->route('admin.categories.index')
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
         DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        return redirect()->route('admin.categories.index');
    }
   
}
