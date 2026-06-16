@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')
<h2 class="mb-3">Danh Sách Bài Viết</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">
        + Thêm bài viết
    </a>

    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh đại diện</th>
                <th>Tên bài viết</th>
                <th>Người đăng</th>
                <th>Nội dung</th>
                <th>Slug</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
@endsection