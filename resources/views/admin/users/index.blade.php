@extends('admin.layouts.admin')

@section('title', 'Người dùng')

@section('content')
    <h2 class="mb-3">Danh Sách Người Dùng</h2>

    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh đại diện</th>
                <th>Họ và tên</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-center">
                        <img src="{{ asset('images/default.png') }}" alt="Avatar" class="img-thumbnail"
                            style="width: 72px; height: 72px; object-fit: cover;">
                    </td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if($item->role == 2)
                            <span class="badge bg-primary">Quản trị</span>
                        @elseif($item->role == 1)
                            <span class="badge bg-secondary">Người dùng</span>
                        @else
                            <span class="badge bg-warning text-dark">Khác</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
