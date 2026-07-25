<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request, $limit = 12)
    {
        $products = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )
            ->where('status', 1)
            ->paginate($limit);

        return view('client.product.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::select(
            'id',
            'cateid',
            'brandid',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image',
            'description'
        )
            ->with([
                'category:cateid,catename',
                'brand:id,brandname,slug',
                'images:id,product_id,image',
            ])
            ->where('slug', $slug)
            ->firstOrFail();
        // sản phẩm liên quan cùng danh muc
        $relatedProducts = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )
            ->where('cateid', $product->cateid)
            ->where('id', '<>', $product->id)
            ->take(4)
            ->get();

        return view('client.product.show', compact(
            'product',
            'relatedProducts'
        ));
    }

    public function category($slug, $limit = 12)
    {
        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'categories.catename'
        )
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->where('categories.slug', $slug)
            ->where('products.status', 1)
            ->paginate($limit);

        return view('client.product.category', compact('products'));
    }

    public function brand($slug, $limit = 12)
    {
        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'brands.brandname'
        )
            ->join('brands', 'products.brandid', '=', 'brands.id')
            ->where('brands.slug', $slug)
            ->where('products.status', 1)
            ->paginate($limit);

        return view('client.product.brand', compact('products'));
    }

    public function search(Request $request, $limit = 12)
    {
        $keyword = trim($request->input('q', ''));
        $sort = $request->input('sort', '');
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        $products = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )
            ->where('status', 1)
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->whereRaw('LOWER(productname) LIKE ?', ['%' . Str::lower($keyword) . '%']);
            })
            ->when(is_numeric($priceMin), function ($query) use ($priceMin) {
                $query->where('price', '>=', $priceMin);
            })
            ->when(is_numeric($priceMax), function ($query) use ($priceMax) {
                $query->where('price', '<=', $priceMax);
            })
            ->when($sort === 'name_asc', function ($query) {
                $query->orderBy('productname', 'asc');
            })
            ->when($sort === 'name_desc', function ($query) {
                $query->orderBy('productname', 'desc');
            })
            ->when($sort === 'price_asc', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sort === 'price_desc', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->paginate($limit)
            ->withQueryString();

        return view('client.product.search', compact('products', 'keyword', 'sort', 'priceMin', 'priceMax'));
    }
}
