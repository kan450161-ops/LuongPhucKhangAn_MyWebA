<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('products')
        //     ->select('id','productname','slug','image','status') //Chỉ lấy các cột cần thiết
        //     ->where('status',1) //Chỉ lấy các loại sản phẩm đang hoạt động
        //     ->orderBy('productname') // Sắp xếp dữ liệu theo cột productname theo thứ tự tăng dần
        //     ->get(); //Lấy tất cả dữ liệu thỏa mãn điều kiện

        //    $list = DB::table('products')
        //         ->join('categories', 'products.cateid', '=', 'categories.cateid')
        //         ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
        //         ->select(
        //             'products.id',
        //             'products.productname',
        //             'products.price',
        //             'products.slug',
        //             'products.image',
        //             'products.status',
        //             'categories.catename',
        //             'brands.brandname'
        //         )
        //         ->orderBy('products.productname')
        //         ->get();

        // $list = Product::select(
        //     'products.id',
        //     'products.productname',
        //     'products.price',
        //     'products.slug',
        //     'products.image',
        //     'products.status',
        //     'categories.catename',
        //     'brands.brandname'
        // )
        // ->join('categories', 'products.cateid', '=', 'categories.cateid')
        // ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
        // ->orderBy('products.productname', 'asc')
        // ->paginate($limit);

        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
        ->select('id','productname','price','slug','image','status','cateid','brandid')
        ->orderBy('productname')
        ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // // Thực hiện Validation dữ liệu
        // // Tự động lưu lỗi vào $errors và chuyển về trang trước nếu Validation thất bại
        // $request->validate(
        //     // Parram 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        // [
        //     'productname' => 'required|min:3|max:100|unique:products,productname',
        //     'slug' => [
        //         'required',
        //         'min:5',
        //         'max:150',
        //         'unique:products,slug',
        //         'regex:/^[a-z0-9-]+$/'
        //     ],
        //     'cateid' => 'required',
        //     'brandid' => 'required',
        //     'price' => 'required|numeric|min:0',
        //     'status' => 'required|in:0,1'
        // ],
        // // Parram 2: Messages - tùy chỉnh nội dung thông báo lỗi.
        // [
        //     'required' => ':attribute không được để trống.',
        //     'min' => ':attribute phải từ :min ký tự trở lên.',
        //     'max' => ':attribute không vượt quá :max ký tự.',
        //     'unique' => ':attribute đã tồn tại.',
        //     'numeric' => ':attribute phải là số.',
        //     'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        //     'status.in' => ':attribute không hợp lệ.'
        // ],
        // // Parram 3: Attributes- tên hiển thị của các trường
        // [
        //     'productname' => 'Tên sản phẩm',
        //     'slug' => 'Đường dẫn (Slug)',
        //     'cateid' => 'Loại sản phẩm',
        //     'brandid' => 'Thương hiệu',
        //     'price' => 'Giá',
        //     'status' => 'Trạng thái'
        // ]
        // );
        try{
        Product::create([
            'productname' => $request->productname,
            'slug' => $request->slug,
            'cateid' => $request->cateid,
            'brandid' => $request->brandid,
            'price' => $request->price,
            'pricediscount' => $request->pricediscount ?? 0,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return redirect()
        ->route('admin.products.index')
        ->with('success', 'Thêm sản phẩm thành công!');
        }catch(\Exception $e){
            return back()
            ->withInput()
            ->with('error', 'Thêm sản phẩm thất bại! Lỗi: ' . $e->getMessage());
        }
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
        $product = Product::find($id);
        $categories = Category::select('cateid', 'catename') -> get();
        $brands = Brand::select('id','brandname') -> get();
        return view('admin.products.edit', compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        // $request->validate(
        //     // Parram 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        // [
        //     'productname' => 'required|min:3|max:100|unique:products,productname,'.$id.',id',
        //     'slug' => [
        //         'required',
        //         'min:5',
        //         'max:150',
        //         'regex:/^[a-z0-9-]+$/',
        //         Rule::unique('products', 'slug')->ignore($id, 'id'),
        //     ],
        //     'cateid' => 'required',
        //     'brandid' => 'required',
        //     'price' => 'required|numeric|min:0',
        //     'status' => 'required|in:0,1'
        // ],
        // // Parram 2: Messages - tùy chỉnh nội dung thông báo lỗi.
        // [
        //     'required' => ':attribute không được để trống.',
        //     'min' => ':attribute phải từ :min ký tự trở lên.',
        //     'max' => ':attribute không vượt quá :max ký tự.',
        //     'unique' => ':attribute đã tồn tại.',
        //     'numeric' => ':attribute phải là số.',
        //     'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        //     'status.in' => ':attribute không hợp lệ.'
        // ],
        // // Parram 3: Attributes- tên hiển thị của các trường
        // [
        //     'productname' => 'Tên sản phẩm',
        //     'slug' => 'Đường dẫn (Slug)',
        //     'cateid' => 'Loại sản phẩm',
        //     'brandid' => 'Thương hiệu',
        //     'price' => 'Giá',
        //     'status' => 'Trạng thái'
        // ]
        // );
            try {

            // Kiểm tra loại sản phẩm
            if (empty($request->cateid)) {

                return back()
                    ->withInput()
                    ->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            if (!$product) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // thực hiện cập nhật sản phẩm
            $product->update([
                'productname'  => $request->productname,
                'cateid'       => $request->cateid,
                'brandid'      => $request->brandid,
                'price'        => $request->price,
                'pricediscount'=> $request->pricediscount,
                'status'       => $request->status,
                'description'  => $request->description
            ]);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');

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
