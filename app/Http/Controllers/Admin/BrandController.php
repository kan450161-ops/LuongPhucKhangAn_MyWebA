<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {   
        // query builder
        // DB::table('brands')->insert([
        //     'brandname' => $request->brandname,
        //     'slug' => $request->slug
        // ]);
        // Eloquent ORM
        Brand::create([
            'brandname' => $request->brandname,
            'slug' => $request->slug
        ]);

        return redirect()->route('admin.brands.index');
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
        return"Edit Brand with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return"Update Brand with id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete Brand with id: $id";
    }
}
