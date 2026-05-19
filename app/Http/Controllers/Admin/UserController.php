<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return"Hello User";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return"Create User";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return"Store User";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return"Show User with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return"Edit User with id: $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return"Update User with id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return"Delete User with id: $id";
    }
}
