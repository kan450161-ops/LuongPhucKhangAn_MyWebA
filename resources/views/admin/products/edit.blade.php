@extends('admin.layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')

<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Sửa sản phẩm</h3>
          <!-- gọi component -->
    <x-admin.alert />

    
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class= "row" >
            <div class="col-md-10">
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text"
                        name="productname"
                        class="form-control"
                        value="{{ old('productname', $product->productname) }}" required>
                          <!-- hiện thị lỗi  -->
                        @error('productname')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug', $product->slug) }}" required>
                        <!-- hiện thị lỗi  -->
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
                    <div class="img-preview mt-2">
                        @if ($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}"
                            class="img-thumbnail" width="120">
                        @endif

                        @error('imgs')
                            <span class="text-danger">{{ $message}} </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 img-group">
                    <label class="form-label">Hình ảnh phụ</label>
                    <input type="file" name="imgs[]" class="form-control img-input" multiple>
                    <div class="img-preview mt-2">
                        @foreach ($product->images as $image)
                            <div class="d-inline-block position-relative me-2 mb-2 image-item">
                                <img src="{{ asset('storage/products/' . $image->image) }}"
                                    class="img-thumbnail" width="100">
                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-image-btn"
                                    data-product-id="{{ $product->id }}"
                                    data-image-id="{{ $image->id }}"
                                    title="Xóa ảnh phụ">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        @endforeach
                        <div id="image-delete-feedback" class="mt-2"></div>
                        <!-- hiện thị lỗi cho trường imgs -->
                        @error('imgs')
                            <span class="text-danger">{{ $message}} </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại sản phẩm</label>

                    <select name="cateid" class="form-select">
                        @foreach($categories as $category)
                        <option
                            value="{{ $category->cateid }}"
                            {{ old('cateid',$product->cateid) == $category->cateid ? 'selected' : '' }}>
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
                        @foreach($brands as $brand)
                        <option
                            value="{{ $brand->id }}"
                            {{ old('brandid',$product->brandid) == $brand->id ? 'selected' : '' }}>
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

                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price', $product->price) }}" required>
                        <!-- hiện thị lỗi  -->
                        @error('price')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number"
                        name="pricediscount"
                        class="form-control"
                        value="{{ old('pricediscount', $product->pricediscount) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">
                        Trạng thái
                    </label>
                    <input type="radio"
                        class="btn-check"
                        name="status"
                        id="active"
                        value="1"
                        {{ old('status',$product->status) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success"
                        for="active">
                        Hiển thị
                    </label>
                    <input type="radio"
                        class="btn-check"
                        name="status"
                        id="inactive"
                        value="0"
                        {{ old('status',$product->status) == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger"
                        for="inactive">
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
                    <label class="form-label">
                        Mô tả sản phẩm
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mb-3">
            Cập nhật
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">
            Quay lại
        </a>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-image-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const imageId = this.dataset.imageId;
            const wrapper = this.closest('.image-item');
            const feedback = document.getElementById('image-delete-feedback');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch(`/admin/products/${productId}/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(function (response) {
                return response.json().then(function (data) {
                    if (!response.ok) {
                        throw new Error(data.message || 'Xóa ảnh phụ thất bại');
                    }
                    return data;
                });
            })
            .then(function (data) {
                if (data.success) {
                    wrapper.remove();
                    feedback.innerHTML = '<div class="alert alert-success py-2">' + data.message + '</div>';
                }
            })
            .catch(function (error) {
                feedback.innerHTML = '<div class="alert alert-danger py-2">' + error.message + '</div>';
            });
        });
    });
});
</script>

@endsection