@extends('admin.layouts.admin')

@section('title', 'Thương hiệu')

@section('content')
    
<h2 class="mb-3">Danh Sách Thương Hiệu</h2>

    <a href="{{ route('admin.brands.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Thêm thương hiệu
    </a>
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh đại diện</th>
                <th>Tên thương hiệu</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
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
                    <td>{{ $item->brandname }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $item->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="{{ route('admin.brands.destroy', $item->id) }}"
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
