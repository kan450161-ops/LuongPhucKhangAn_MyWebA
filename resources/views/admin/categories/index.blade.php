<!-- thừa kế layout/view admin.blade.php
    resources/views/admin/layouts/admin.blade.php -->
@extends('admin.layouts.admin')

<!-- gán nội dung cho vùng section 'title'
tương ứng với @yield('title') trong layout -->

@section('title', 'Loại sản phẩm')

<!-- gán nội dung cho vung section 'content'
tương ứng với @yield('content') trong layout --> 
@section('content')
    <h2 class="mb-3">Danh Sách Loại Sản Phẩm</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
        + Thêm loại sản phẩm
    </a>
    <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
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

