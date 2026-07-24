@extends('client.layouts.app')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">
        Kết quả tìm kiếm cho: <span class="text-primary">{{ $keyword }}</span>
    </h3>

    <form action="{{ route('search') }}" method="GET" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Từ khóa</label>
                <input type="search" name="q" class="form-control" value="{{ $keyword }}" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="col-md-3">
                <label class="form-label">Khoảng giá</label>
                <div class="input-group">
                    <input type="number" name="price_min" class="form-control" value="{{ $priceMin ?? '' }}" placeholder="Từ">
                    <input type="number" name="price_max" class="form-control" value="{{ $priceMax ?? '' }}" placeholder="Đến">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sắp xếp</label>
                <select name="sort" class="form-select">
                    <option value="">Mặc định</option>
                    <option value="name_asc" {{ ($sort ?? '') === 'name_asc' ? 'selected' : '' }}>Tên A → Z</option>
                    <option value="name_desc" {{ ($sort ?? '') === 'name_desc' ? 'selected' : '' }}>Tên Z → A</option>
                    <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <x-client.product :product="$product" />
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning">
                Không tìm thấy sản phẩm phù hợp với từ khóa "<strong>{{ $keyword }}</strong>".
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
