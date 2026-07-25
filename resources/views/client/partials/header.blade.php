<div class="bg-dark text-white py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- {{-- Thông tin liên hệ --}} -->
            <div class="col-md-6">
                <small>
                    Hotline: 0909 999 999 |✉ Email: <strong>{{ Auth::check() ? Auth::user()->email : 'support@example.com' }}</strong>
                </small>
            </div>
            <!-- {{-- Tài khoản --}} -->
            <div class="col-md-6 text-md-end">
                <small>
                    @if(Auth::check())
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none me-3">
                                Về Admin
                            </a>
                        @endif
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-white text-decoration-none p-0 me-3">
                                Đăng xuất
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}" class="text-white text-decoration-none me-3">
                            Đăng nhập
                        </a>
                        <a href="{{ route('register.show') }}" class="text-white text-decoration-none me-3">
                            Đăng ký
                        </a>
                        <a href="{{ route('contact.show') }}" class="text-white text-decoration-none">
                            Liên hệ
                        </a>
                    @endif
                </small>
            </div>
        </div>
    </div>
</div>