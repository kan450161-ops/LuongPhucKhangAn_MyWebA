@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')
<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Sửa Bài Viết</h3>
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

    <form action="{{ route('admin.posts.update', $posts->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên Bài Viết</label>
            <input type="text" name="title" class="form-control"
            value="{{ old('title', $posts->title ) }}">
            <!-- hiện thị lỗi  -->
                        @error('title')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control"
            value="{{ old('slug', $posts->slug) }}">
            <!-- hiện thị lỗi  -->
                        @error('slug')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nội Dung</label>
            <input type="text" name="content" class="form-control"
            value="{{ old('content', $posts->content) }}">
            <!-- hiện thị lỗi  -->
                        @error('content')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Người Đăng</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                <option value="{{ $user->userid }}"
                    {{ old('user_id',$posts->user_id) == $user->userid ? 'selected' : '' }} >
                    {{ $user->fullname }}
                </option>
                @endforeach
            </select>
            <!-- hiện thị lỗi  -->
                        @error('user_id')
                            <span class = " text-danger ">
                                {{$message}}
                            </span>
                        @enderror
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Trạng thái</label>
            <input type="radio" class="btn-check" name="status" id="active" value="1" 
                {{ old('status',$posts->status) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="active">
                Hiển thị
            </label>
            <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                {{ old('status',$posts->status) == 0 ? 'checked' : '' }}>
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



        <button type="submit" class="btn btn-primary mb-3">
            Cập nhật
        </button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mb-3">
            Quay lại
        </a>
    </form>
</div>

@endsection