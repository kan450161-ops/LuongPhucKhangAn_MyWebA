@extends('client.layouts.app')

@section('title', $products->first()?->brand?->brandname ?? 'Thương hiệu')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">
        Thương hiệu: {{ $products->first()?->brand?->brandname ?? 'Không xác định' }}
    </h3>

    <div class="row g-4">
        @forelse ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <x-client.product :product="$product" />
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning">
                Không có sản phẩm nào cho thương hiệu này.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
