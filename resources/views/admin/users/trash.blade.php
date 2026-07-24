@extends('admin.layouts.admin')
@section('title', 'Trash-Người dùng')
@section('content')

<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG - ĐANG CHỜ XÓA</h2>
{{-- gọi component --}}
<x-admin.alert />
<a href="{{ route('admin.users.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle-fill"></i>
    Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
           <th>STT</th>
            <th>Ảnh đại diện</th>
            <th>Họ và tên</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
            <th width="150">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
                    <td class="text-center"> 
                        @if ($item->image)
                            <img src="{{ asset('storage/users/'. $item->image) }}" 
                            width="80" class="img-thumnail">
                        @endif
                    </td><!--//Nếu có ảnh thì hiển thị ảnh, nếu không có thì hiển thị ảnh mặc định -->
                     <td>{{ $item->fullname }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
            <td>
                @if($item->role == 1)
                    <span class="badge bg-primary">Quản trị</span>
                @elseif($item->role == 2)
                    <span class="badge bg-secondary">Người dùng</span>
                @else
                    <span class="badge bg-warning text-dark">Khác</span>
                @endif
            </td>
            <td>
                @if ($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.users.restore', $item->userid)}}" method="POST" class="d-inline">

                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.users.forceDelete', $item->userid) }}" method="POST"
                    class="d-inline">

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
{{-- hiển thị phân trang --}}
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection