<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input type="text" name="productname" class="form-control">
    </div>

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Lưu
    </button>
</form>