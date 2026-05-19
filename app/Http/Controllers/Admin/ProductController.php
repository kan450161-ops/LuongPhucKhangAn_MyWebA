<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return"Hello Product";
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
