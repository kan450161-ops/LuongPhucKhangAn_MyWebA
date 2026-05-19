<!-- thừa kế layout/view admin.blade.php
    resources/views/admin/layouts/admin.blade.php -->
@extends('admin.layouts.admin')

<!-- gán nội dung cho vùng section 'title'
tương ứng với @yield('title') trong layout -->

@section('title', 'Admin Dashboard')

<!-- gán nội dung cho vung section 'content'
tương ứng với @yield('content') trong layout --> 
@section('content')
    <h1>Welcome to Admin Dashboard</h1>
@endsection