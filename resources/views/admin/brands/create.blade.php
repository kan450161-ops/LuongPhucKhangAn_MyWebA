<!-- thừa kế layout/view admin.blade.php
    resources/views/admin/layouts/admin.blade.php -->
@extends('admin.layouts.admin')

<!-- gán nội dung cho vùng section 'title'
tương ứng với @yield('title') trong layout -->

@section('title', 'Loại sản phẩm')

<!-- gán nội dung cho vung section 'content'
tương ứng với @yield('content') trong layout --> 
@section('content')

<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Thêm Thương Hiệu</h3>
    
    <!-- gọi component -->
    <x-admin.alert />

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class = "row">
            <div class="col-md-10">
                <div class="mb-3">
                    <label>Tên loại thương hiệu</label>
                    <input type="text" name="brandname" class="form-control"
                    value="{{ old ('brandname') }}" require>
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control"
                    value="{{ old('slug') }}" required>
                </div>

                <div class = "mb-3 img-group">
                    <label class = "form-label">Hình Ảnh</label>
                    <input type="file" name="img" class = "form-control img-input">
                    <div class="img-preview mt-2"></div>
                    <!-- hiện thị lỗi cho trường img -->
                    @error('img')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1" 
                        {{ old('status') == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">
                        Hiển thị
                    </label>
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                        {{ old('status') == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">
                        Ẩn
                    </label>
                </div>

                <div class="mb-3">
                    <label>Sắp xếp</label>
                    <input type="text" name="sort_order" class="form-control"
                    value="{{ old ('sort_order'), 0 }}" >

                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mb-3">
            Lưu
        </button>

        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary mb-3">
            Quay lại
        </a>

    </form>
</div>
@endsection