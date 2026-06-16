<form action="{{ route('admin.posts.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Lưu
    </button>
</form>