<div class="bg-white rounded-lg shadow border border-gray-200 p-6">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">
        Tạo tài khoản Admin
    </h3>

    <x-admin.alert />

    <form action="{{ route('admin.register.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Cột trái -->
            <div>

                <!-- Họ và tên -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Họ và tên
                    </label>
                    <input
                        type="text"
                        name="fullname"
                        value="{{ old('fullname') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                    @error('fullname')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Tên đăng nhập
                    </label>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                    @error('username')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Mật khẩu
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Xác nhận mật khẩu
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                </div>

            </div>

            <!-- Cột phải -->
            <div>

                <!-- Phone -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Số điện thoại
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Địa chỉ
                    </label>
                    <input
                        type="text"
                        name="address"
                        value="{{ old('address') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Vai trò
                    </label>
                    <select
                        name="role"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    >
                        <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>
                            User
                        </option>
                    </select>
                </div>

            </div>

        </div>

        <div class="flex items-center gap-3 mt-6">
            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700 transition"
            >
                Tạo
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="rounded-lg bg-gray-500 px-5 py-2.5 text-white hover:bg-gray-600 transition"
            >
                Quay lại
            </a>
        </div>
    </form>
</div>