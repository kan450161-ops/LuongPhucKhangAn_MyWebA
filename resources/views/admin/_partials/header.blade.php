<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Panel</span>
        <div class="d-flex align-items-center gap-3">
            <span>Xin chào <strong>{{ Auth::user()->fullname }}</strong></span>
            @if(Auth::user()->role == 1)
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                    Xem trang khách hàng
                </a>
            @endif
            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-decoration-none">
                    Đăng xuất
                </button>
            </form>
        </div>
    </div>
</nav>