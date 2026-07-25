<footer class="bg-dark text-white mt-5 pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- {{-- Cột 1: --}} -->
            <div class="col-md-4 mb-4">
                <h5>King Shop</h5>
                <p>
                    King Shop chuyên cung cấp các sản phẩm công nghệ,
                    phụ kiện máy tính và thiết bị điện tử với chất lượng
                    và giá cả hợp lý.
                </p>
            </div>
            <!-- {{-- Cột 2: --}} -->
            <div class="col-md-4 mb-4">
                <h5>Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="/" class="text-white text-decoration-none">
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none">
                            Sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none">
                            Giỏ hàng
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none">
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
            <!-- {{-- Cột 3: --}} -->
            <div class="col-md-4 mb-4">
                <h5>Liên hệ</h5>
                <p> Địa chỉ: <strong>{{ Auth::check() ? Auth::user()->address : '123 Nguyễn Văn A, TP. Hồ Chí Minh' }}</strong></p>
                <p> SĐT: <strong>{{ Auth::check() ? Auth::user()->phone : '0909 999 999' }}</strong></p>
                <p>✉ Email: <strong>{{ Auth::check() ? Auth::user()->email : 'support@example.com' }}</strong></p>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <small>
                © 2026 King Shop. All Rights Reserved.
            </small>
        </div>
    </div>
</footer>