<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Sản phẩm mới nhất (lấy 8 sản phẩm mới nhất)
        $newProducts = Product::where('status', 1)
            ->select(
                'id',
                'productname',
                'slug',
                'price',
                'pricediscount',
                'image',
                'status'
            )
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
        // Sản phẩm giảm giá (lấy 8 sản phẩm mới nhất)
        $saleProducts = Product::where('status', 1)
            ->select(
                'id',
                'productname',
                'slug',
                'price',
                'pricediscount',
                'image',
                'status',
            )
            ->where('pricediscount', '>', 0)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
        // Sản phẩm bán chạy (lấy 8 sản phẩm mới nhất)
        // $bestSellingProducts = Product::where('status', 1)
        //     ->select(
        //         'id',
        //         'productname',
        //         'price',
        //         'pricediscount',
        //         'image',
        //         'status',
        //     )
        //     ->where('sold', '>', 0)
        //     ->orderByDesc('sold')
        //     ->take(4)
        //     ->get();   

        return view('client.home.index', compact(
            'newProducts',
            'saleProducts'
        ));
    }
}
