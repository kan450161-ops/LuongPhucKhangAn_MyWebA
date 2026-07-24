@extends('admin.layouts.admin')

@section('title', 'Đơn hàng')

@section('content')

<h2 class="mb-3">DANH SÁCH ĐƠN HÀNG</h2>

<div class="mb-3 d-flex justify-content-between">
    <div>
        <form class="d-flex" method="GET">
            <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo mã đơn hoặc tên khách" value="{{ request('q') }}">
            <select name="status" class="form-select me-2">
                <option value="">-- Trạng thái --</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status')=='processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>

    <div class="text-end">
        <div><strong>Tổng đơn hàng:</strong> {{ $totalOrders }}</div>
        <div><strong>Tổng doanh thu:</strong> {{ number_format($totalRevenue, 0) }} đ</div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Mã đơn</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $orders->firstItem() + $loop->index }}</td>
                <td>{{ $order->order_code }}</td>
                <td>{{ $order->customer?->name }}</td>
                <td>{{ number_format($order->total_amount, 0) }} đ</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">Xem</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Không có dữ liệu</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>

@endsection
