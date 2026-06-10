<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Họ và tên</label>
        <input type="text" name="fullname" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Lưu
    </button>
</form>