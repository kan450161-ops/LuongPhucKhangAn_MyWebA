@extends('client.layouts.app')

@section('title', 'Trang chủ')

@section('content')

<div class="container">

    <!-- Sản phẩm mới -->
    <section class="mb-5">
        <h3 class="mb-4">🆕 Sản phẩm mới nhất</h3>
        <div class="row">
            @forelse($newProducts as $product)
            <div class="col-md-3 mb-4">
                {{-- <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->productname }}" style="height:120px;object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $product->productname }}
                        </h5>
                        @if($product->pricediscount > 0)
                        <h6 class="text-danger">
                            {{ number_format($product->pricediscount) }} đ
                        </h6>
                        <small class="text-decoration-line-through text-muted">
                            {{ number_format($product->price) }} đ
                        </small>
                        @else
                        <h6 class="text-danger">
                            {{ number_format($product->price) }} đ
                        </h6>
                        @endif
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-primary w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div> --}}
                <x-client.product :product="$product" />
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Chưa có sản phẩm.
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Sản phẩm giảm giá -->
    <section>
        <h3 class="mb-4">🔥 Sản phẩm giảm giá</h3>
        <div class="row">
            @forelse($saleProducts as $product)
            <div class="col-md-3 mb-4">
                {{-- <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->productname }}" style="height:120px;object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $product->productname }}
                        </h5>
                        <h6 class="text-danger">
                            {{ number_format($product->pricediscount) }} đ
                        </h6>
                        <small class="text-decoration-line-through text-muted">
                            {{ number_format($product->price) }} đ
                        </small>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-primary w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div> --}}
                <x-client.product :product="$product" />
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Chưa có sản phẩm giảm giá.
                </div>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection