@extends('client.layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="mb-1">Danh sách sản phẩm</h3>
            <p class="text-muted mb-0">Tất cả sản phẩm đang bán trên cửa hàng.</p>
        </div>
        <div class="text-muted small">Tổng: {{ $products->total() }} sản phẩm</div>
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <x-client.product :product="$product" />
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning">
                Hiện chưa có sản phẩm nào.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection