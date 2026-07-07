<!-- {{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}} -->
@extends('admin.layouts.admin')

<!-- {{-- Gán nội dung cho vùng section 'title' --}}
 (tương ứng với @yield('title') trong layout -->
@section('title', 'Loại Sản phẩm')

<!-- {{-- Gán nội dung cho vùng section 'content' --}}
 (tương ứng với @yield('content') trong layout -->
@section('content')

<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Thêm Sản phẩm</h3>

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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productname" class="form-control" 
                        value="{{ old('productname') }}" required>
                        <!-- hiện thị lỗi  -->
                        @error('productname')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" 
                        value="{{ old('slug') }}" required>
                         <!-- hiện thị lỗi  -->
                        @error('slug')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
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
                    <div class = "mb-3 img-group">
                        <label class = "form-label">Hình Ảnh Phụ</label>
                        <input type="file" name="imgs[]" class = "form-control img-input" multiple>
                        <div class="img-preview mt-2"></div>
                        <!-- hiện thị lỗi cho trường img -->
                        @error('imgs')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại sản phẩm</label>
                        <select name="cateid" class="form-select">
                            <option value="">-- Chọn loại sản phẩm --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->cateid }}"
                                {{ old('cateid') == $category->cateid ? 'selected' : '' }} >
                                {{ $category->catename }}
                            </option>
                            @endforeach
                        </select>
                         <!-- hiện thị lỗi  -->
                        @error('cateid')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brandid" class="form-select">
                            <option value="">-- Chọn thương hiệu --</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" 
                                {{ old('brandid') == $brand->id ? 'selected' : '' }} >
                                {{ $brand->brandname }}
                            </option>
                            @endforeach
                        </select>
                         <!-- hiện thị lỗi  -->
                        @error('brandid')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" required
                        value="{{ old('price') }}">
                         <!-- hiện thị lỗi  -->
                        @error('price')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="pricediscount" class="form-control" value="{{ old('pricediscount') ?? 0 }}">
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
                         <!-- hiện thị lỗi  -->
                        @error('status')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
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
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">
            Quay lại
            </a>

        </form>
</div>
@endsection