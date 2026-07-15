<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form action="{{ route('admin.forgotpass.post') }}" method="POST" class="shadow-lg p-4 bg-light rounded">
                    @csrf
                    <h3 class="mb-3">Quên mật khẩu</h3>
                    <x-admin.alert></x-admin.alert>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email đăng ký" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gửi yêu cầu</button>
                    <div class="mt-3 text-center">
                        <a href="{{ route('admin.login') }}">Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
