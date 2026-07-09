<!-- thừa kế layout/view admin.blade.php
    resources/views/admin/layouts/admin.blade.php -->
@extends('admin.layouts.admin')

<!-- gán nội dung cho vùng section 'title'
tương ứng với @yield('title') trong layout -->

@section('title', 'Đổi mật khẩu')

<!-- gán nội dung cho vung section 'content'
tương ứng với @yield('content') trong layout --> 
@section('content')

<div class="container">

    <h3 class="mb-4">
        Đổi mật khẩu
    </h3>

     <!-- gọi component -->
    <x-admin.alert />

    <div class="card">

        <div class="card-body">

            <p>
                <strong>Họ tên:</strong>
                {{ Auth::user()->fullname }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ Auth::user()->email }}
            </p>

            <form action="{{ route('admin.change.password') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Mật khẩu cũ</label>

                    <input
                        type="password"
                        name="old_password"
                        class="form-control">

                    @error('old_password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Mật khẩu mới</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Xác nhận mật khẩu</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

                <button class="btn btn-primary">
                    Đổi mật khẩu
                </button>

            </form>

        </div>

    </div>

</div>

@endsection