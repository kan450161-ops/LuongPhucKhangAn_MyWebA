@extends('admin.layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')

<h2 class="mb-3">CHI TIẾT ĐƠN HÀNG</h2>

<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mb-3">Quay lại</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <h5>Thông tin khách hàng</h5>
        <p><strong>Tên:</strong> {{ $order->customer?->name }}</p>
        <p><strong>Email:</strong> {{ $order->customer?->email }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->customer?->address }}</p>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5>Sản phẩm</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product?->productname }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0) }} đ</td>
                        <td>{{ number_format($item->price * $item->quantity, 0) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h4>Tổng: {{ number_format($order->total_amount, 0) }} đ</h4>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status=='completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button class="btn btn-primary">Cập nhật trạng thái</button>
        </form>
    </div>
</div>

@endsection
