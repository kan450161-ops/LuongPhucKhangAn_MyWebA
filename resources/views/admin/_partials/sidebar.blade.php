<div class="admin-sidebar bg-dark text-white p-3 vh-100">
    <h4 class="mb-4">
        <i class="bi bi-speedometer2"></i>
        Admin
    </h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('admin.home') }}">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link text-white" href="/admin/dashboard">
                <i class="bi bi-house-door"></i>
                Dashboard ****
            </a>
        </li> -->
        <!-- {{-- Menu expand --}} -->
        <!-- {{-- Quản lý danh mục --}} -->
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#categoryMenu">
                <i class="bi bi-tags"></i>
                Quản lý danh mục
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="categoryMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
                            Danh sách loại sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
                            + Thêm loại sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.edit', ['id' => 1]) }}">
                            + Sửa loại sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- {{-- Quản lý thương hiệu --}} -->
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#brandMenu">
                <i class="bi bi-shop"></i>
                Quản lý thương hiệu
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="brandMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.brands.index') }}">
                            Danh sách thương hiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.brands.create') }}">
                            + Thêm thương hiệu
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- {{-- Quản lý người dùng --}} -->
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#userMenu">
                <i class="bi bi-people"></i>
                Quản lý người dùng
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="userMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                            Danh sách người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users.create') }}">
                            + Thêm người dùng
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- {{-- Quản lý bài viết --}} -->
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#postMenu">
                <i class="bi bi-file-text"></i>
                Quản lý bài viết
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="postMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.posts.index') }}">
                            Danh sách bài viết
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.posts.create') }}">
                            + Thêm bài viết
                        </a>
                </ul>
            </div>
        </li>
        <!-- {{-- Quản lý sản phẩm --}} -->
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#productMenu">
                <i class="bi bi-box-seam"></i>
                Quản lý sản phẩm
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="productMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                            Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.create') }}">
                            + Thêm sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>