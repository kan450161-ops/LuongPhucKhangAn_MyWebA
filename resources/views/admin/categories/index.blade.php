<!-- thừa kế layout/view admin.blade.php
    resources/views/admin/layouts/admin.blade.php -->
@extends('admin.layouts.admin')

<!-- gán nội dung cho vùng section 'title'
tương ứng với @yield('title') trong layout -->

@section('title', 'Loại sản phẩm')

<!-- gán nội dung cho vung section 'content'
tương ứng với @yield('content') trong layout --> 
@section('content')
    <h2 class="mb-3">Danh Sách Loại Danh Mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Thêm loại danh mục
    </a>
    <a href="{{ route('admin.categories.trash') }}" class="btn btn-danger mb-3">
        <i class="bi bi-trash-fill"></i>
        Thùng rác
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
                    <th>Ảnh đại diện</th>
                    <th>Mã loại</th>
                    <th>Tên loại</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th width="150">Thao tác</th>
                </tr>
            </thead>

        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-center"> 
                        @if ($item->image)
                            <img src="{{ asset('storage/categories/'. $item->image) }}" 
                            width="80" class="img-thumnail">
                        @endif
                    </td><!--//Nếu có ảnh thì hiển thị ảnh, nếu không có thì hiển thị ảnh mặc định -->
                    <td>{{ $item->cateid }}</td>
                    <td>{{ $item->catename }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $item->cateid) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="{{ route('admin.categories.destroy', $item->cateid) }}"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
   
@endsection

