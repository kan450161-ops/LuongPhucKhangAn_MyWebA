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
    <h3 class="mb-4">Sửa Thương Hiệu</h3>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('admin.brands.update', $brands-> id) }}" method="POST">
        @csrf
        <div class = "row">
            <div class="col-md-10">
                <div class="mb-3">
                    <label>Tên loại thương hiệu</label>
                    <input type="text" name="brandname" class="form-control"
                    value="{{ old ('brandname',$brands -> brandname) }}" require>
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control"
                    value="{{ old('slug',$brands -> slug) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1" 
                        {{ old('status', $brands -> status) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">
                        Hiển thị
                    </label>
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                        {{ old('status', $brands -> status) == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">
                        Ẩn
                    </label>
                </div>

                <div class="mb-3">
                    <label>Sắp xếp</label>
                    <input type="text" name="sort_order" class="form-control"
                    value="{{ old ('sort_order', $brands->sort_order) }}" >

                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $brands->description) }}</textarea>
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