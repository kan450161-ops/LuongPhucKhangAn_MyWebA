@extends('admin.layouts.admin')

@section('title', 'Người dùng')

@section('content')

<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Thêm người dùng</h3>

        <!-- @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>    
                @endforeach
            </ul>
        </div>
        @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif -->

      <!-- gọi component -->
    <x-admin.alert />

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <label>Họ và tên</label>
                    <input type="text" name="fullname"
                        class="form-control"
                        value="{{ old('fullname') }}">
                        <!-- hiện thị lỗi  -->
                        @error('fullname')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="username"
                        class="form-control"
                        value="{{ old('username') }}">
                        <!-- hiện thị lỗi  -->
                        @error('username')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                        class="form-control"
                        value="{{ old('email') }}">
                        <!-- hiện thị lỗi  -->
                        @error('email')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Mật khẩu</label>
                    <input type="password"
                        name="password"
                        class="form-control">
                        <!-- hiện thị lỗi  -->
                        @error('password')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}">
                        <!-- hiện thị lỗi  -->
                        @error('phone')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text"
                        name="address"
                        class="form-control"
                        value="{{ old('address') }}">
                        <!-- hiện thị lỗi  -->
                        @error('address')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label>Giới tính</label>
                    <select name="gender" class="form-select">
                        <option value="1"{{ old('gender') == '1' ? 'selected' : '' }}>Nam</option>
                        <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Nữ</option>
                        <!-- hiện thị lỗi  -->
                        @error('gender')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                    </select>
                </div>

                <div class="mb-3">
                    <label>Ngày sinh</label>
                    <input type="date"
                        name="birthday"
                        class="form-control"
                        value="{{ old('birthday') }}">
                        <!-- hiện thị lỗi  -->
                        @error('birthday')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Vai trò</label>
                    <select name="role" class="form-select">
                        <option value="2"{{ old('role') == '2' ? 'selected' : '' }}>Admin</option>
                        <option value="1"{{ old('role') == '1' ? 'selected' : '' }}>User</option>
                    </select>
                    <!-- hiện thị lỗi  -->
                        @error('role')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1" 
                        {{ old('status') == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">
                        Hoạt Động
                    </label>
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                        {{ old('status') == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">
                        Khóa
                    </label>
                    <!-- hiện thị lỗi  -->
                        @error('status')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Lưu
        </button>

        <a href="{{ route('admin.users.index') }}"
            class="btn btn-secondary">
            Quay lại
        </a>

    </form>
</div>

@endsection