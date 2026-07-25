<!-- {{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}} -->
@extends('admin.layouts.admin')

@section('title', 'Xin chào')

@section('content')
    @php
        $stats = [
            ['label' => 'Sản phẩm', 'value' => number_format(\App\Models\Product::count()), 'icon' => 'box-seam', 'color' => 'primary'],
            ['label' => 'Đơn hàng', 'value' => number_format(\App\Models\Order::count()), 'icon' => 'cart3', 'color' => 'success'],
            ['label' => 'Khách hàng', 'value' => number_format(\App\Models\Customer::count()), 'icon' => 'people', 'color' => 'warning'],
            ['label' => 'Bài viết', 'value' => number_format(\App\Models\Post::count()), 'icon' => 'journal-text', 'color' => 'info'],
        ];
    @endphp

    <div class="container-fluid p-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <div>
                <h2 class="fw-bold mb-1">My Dashboard</h2>
                <p class="text-muted mb-0">Tổng quan hoạt động quản trị hệ thống của bạn</p>
            </div>
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                <i class="bi bi-circle-fill me-2" style="font-size: 0.6rem;"></i>
                Trực tuyến
            </span>
        </div>

        <div class="row g-3 mb-4">
            @foreach ($stats as $stat)
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">{{ $stat['label'] }}</p>
                                    <h3 class="fw-bold mb-0">{{ $stat['value'] }}</h3>
                                </div>
                                <div class="rounded-circle p-3 bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }}">
                                    <i class="bi bi-{{ $stat['icon'] }} fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-4">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">Hoạt động gần đây</h5>
                                <p class="text-muted small mb-0">Cập nhật nhanh các mục chính trong hệ thống</p>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Đơn hàng mới</h6>
                                        <p class="text-muted mb-0 small">Theo dõi trạng thái và xử lý đơn hàng đang chờ</p>
                                    </div>
                                    <span class="badge bg-success-subtle text-success">Mới</span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Quản lý sản phẩm</h6>
                                        <p class="text-muted mb-0 small">Cập nhật thông tin và hình ảnh sản phẩm</p>
                                    </div>
                                    <span class="badge bg-info-subtle text-info">Sắp xếp</span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Khách hàng liên hệ</h6>
                                        <p class="text-muted mb-0 small">Xem và phản hồi các yêu cầu từ khách hàng</p>
                                    </div>
                                    <span class="badge bg-warning-subtle text-warning">Chờ xử lý</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Thao tác nhanh</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-folder-plus me-2"></i>Thêm danh mục
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success">
                                <i class="bi bi-cart-check me-2"></i>Quản lý đơn hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection