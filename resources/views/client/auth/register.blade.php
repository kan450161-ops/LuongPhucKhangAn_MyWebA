@extends('client.layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="h4 mb-4">Đăng ký tài khoản</h2>

                    <x-admin.alert />

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control">
                            @error('fullname')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                            @error('username')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection