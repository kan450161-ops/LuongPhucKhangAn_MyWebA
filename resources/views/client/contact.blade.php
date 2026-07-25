@extends('client.layouts.app')

@section('title', 'Liên hệ')

@section('content')

<h2 class="mb-3">Liên hệ</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Họ & Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="message" rows="6" class="form-control">{{ old('message') }}</textarea>
                @error('message')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <button class="btn btn-primary">Gửi liên hệ</button>
        </form>
    </div>

    <div class="col-md-4">
        <h5>Thông tin liên hệ</h5>
        <p>Địa chỉ: <strong>{{ Auth::check() ? Auth::user()->address : '123 Đường ABC, Thành phố XYZ' }}</strong></p>
        <p>Email: <strong>{{ Auth::check() ? Auth::user()->email : 'support@example.com' }}</strong></p>
        <p>Phone:<strong>{{ Auth::check() ? Auth::user()->phone : '0123-456-789' }}</strong></p>
    </div>
</div>

@endsection
