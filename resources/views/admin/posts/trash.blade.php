@extends('admin.layouts.admin')

@section('title', 'Trash bài viết')

@section('content')

<h2 class="mb-3">DANH SÁCH BÀI VIẾT - ĐANG CHỜ XÓA</h2>

<!-- {{-- gọi component --}} -->
<x-admin.alert />

<a href="{{ route('admin.posts.index') }}" class="btn btn-primary mb-2">
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
            <th>Ảnh đại diện</th>
            <th>Tên bài viết</th>
            <th>Người đăng</th>
            <th >Nội dung</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th width="100">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
             <td>{{ $loop->iteration }}</td>
                    <td class="text-center"> 
                        <img src="{{ $item->image ? asset('images/' . $item->image) : asset('images/default.png') }}"
                        alt="Logo" class="img-thumbnail" style="width: 72px; height: 72px; object-fit: cover;">
                    </td><!--//Nếu có ảnh thì hiển thị ảnh, nếu không có thì hiển thị ảnh mặc định -->
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->user->username ?? '—' }}</td>
                    <td>{{ Str::limit($item->content, 100) }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $item->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="{{ route('admin.posts.destroy', $item->id) }}"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                            <i class="bi bi-trash"></i>
                        </a>
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