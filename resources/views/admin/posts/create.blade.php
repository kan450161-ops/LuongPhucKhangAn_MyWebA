<form action="{{ route('admin.posts.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tên bài viết</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <div class="mb-3">
        <label>Người đăng</label>
        <select name="user_id" class="form-control">
            <option value="">-- Chọn --</option>
            @foreach($users as $user)
                <option value="{{ $user->userid }}">{{ $user->fullname }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="6"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Lưu
    </button>
</form>