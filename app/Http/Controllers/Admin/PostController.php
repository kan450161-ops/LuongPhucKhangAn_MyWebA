<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return"Hello Post";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return"Create Post";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return"Store Post";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show Post with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return"Edit Post with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return"Update Post with id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete Post with id: $id";
    }
}
