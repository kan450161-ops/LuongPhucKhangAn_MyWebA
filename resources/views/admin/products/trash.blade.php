@extends('admin.layouts.admin')

@section('title', 'Trash-Sản phẩm')

@section('content')

<h2 class="mb-3">DANH SÁCH SẢN PHẨM - ĐANG CHỜ XÓA</h2>

<!-- {{-- gọi component --}} -->
<x-admin.alert />

<a href="{{ route('admin.products.index') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i>   
        Quay lại danh sách
</a>

@if(session('success')) 
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình Sản Phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Loại</th>
            <th>Thương hiệu</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th width="180">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $list->firstItem() + $loop->index }}</td>
                <td class="text-center"> 
                        @if ($item->image)
                            <img src="{{ asset('storage/products/'. $item->image) }}" 
                            width="80" class="img-thumnail">
                        @endif
                    </td><!--//Nếu có ảnh thì hiển thị ảnh, nếu không có thì hiển thị ảnh mặc định -->
                <td>{{ $item->productname }}</td>
                <td>{{ $item->category?->catename }}</td>
                <td>{{ $item->brand?->brandname }}</td>
                <td>{{ number_format($item->price, 1) }} đ</td>
            <td>
                @if ($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.products.restore', $item->id) }}" method="POST" class="d-inline">

                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.products.forceDelete', $item->id) }}" method="POST" class="d-inline">

                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Xóa vĩnh viễn?')" class="btn btn-danger btn-sm">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- {{-- hiển thị phân trang --}} -->

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection