<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\ChangePasswordRequest;


class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        // Kiểm tra đã lưu đăng nhập chưa thì chuyển đến trang phù hợp theo role
        if (Auth::check()) {
            return Auth::user()->role == 1
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }
        return view('admin.auth.login');
    }
    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        // validate - kiểm tra dữ liệu đầu vào
        // bổ sung thêm một số ràng buộc khác - nếu có
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
            ]
        );
        // first(): lấy ra record đầu tiên khi truy vấn dữ liệu
        $user = User::where('username', $request->username)->first();
        // Nếu không tìm thấy người dùng trong bảng users
        if (!$user) {
            return back()
                ->with('message', 'Username không tồn tại')
                ->withInput();
        }
        // Nếu tìm thấy người dùng thì kiểm tra mật khẩu
        // do mật khẩu dùng Hash::make() để mã hóa, nên cần so sánh phải dùng với hàm Hash::check()
        $check = Hash::check($request->password, $user->password); // true hoặc false
        // trường hợp mật khẩu không khớp
        if (!$check) {
            // điều hướng về trước (login) với session flash 'message'
            return back()->with('message', 'Mật khẩu không đúng')->withInput();
        }
        // Nếu biến $remember có giá trị true (nếu người dùng chọn nhớ tài khoản)
        $remember = $request->has('remember') ? true : false;
        Auth::login($user, $remember);

        if ($user->role != 1) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công.');
        }

        // sử dụng intended để điều hướng về URL mà người dùng muốn truy cập
        // nếu không có thì điều hướng về dashboard (route name dashboard được khai báo trong web.php)
        return redirect()->intended(route('admin.dashboard'));
    }
    // Đăng xuất
    public function logout(Request $request)
    {
        $userRole = Auth::check() ? Auth::user()->role : 2;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $userRole == 1
            ? redirect()->route('admin.login')
            : redirect()->route('home');
    }
    // Hiển thị trang Quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    // Xử lý quên mật khẩu
    public function postForgotpassword(Request $request)
    {
        // validate - kiểm tra dữ liệu đầu vào
        $request->validate(
            ['email' => 'required|email'],
            [
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
            ]
        );

        // Kiểm tra email tồn tại
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()
                ->with('error', 'Email không tồn tại')
                ->withInput();
        }

        // Tạo mật khẩu mới
        $passrandom = Str::random(10);
        // Mã hóa mật khẩu
        $passencrypted = Hash::make($passrandom);
        // Lưu vào DB
        $user->update([
            'password' => $passencrypted,
        ]);

        // Nội dung email
        $html = "<h2> Mật khẩu mới của bạn là: $passrandom </h2> 
                <p>Vui lòng đổi mật khẩu sau khi đăng nhập.</p>";

        // Gửi email
        Mail::html($html, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Đặt lại mật khẩu');
        });

        // điều hướng về page forgot kèm thông báo
        return redirect()
            ->route('admin.forgotpass')
            ->with('message', 'Đã gửi mật khẩu mới. Bạn vui lòng kiểm tra email của bạn')
            ->with('status', 'Đã gửi mật khẩu mới. Bạn vui lòng kiểm tra email của bạn');
    }

    //change password
    public function showChangePassword()
    {
        return view('admin.auth.change-password');
    }

    //xử lý đổi mật khẩu
    public function changePassword(ChangePasswordRequest $request)
    {
       $user = User::find(Auth::id());
        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->old_password, $user->password)) {

            return back()
                ->withErrors([
                    'old_password' => 'Mật khẩu cũ không chính xác.'
                ])
                ->withInput();
        }

        // cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()
            ->route('admin.change.password')
            ->with('success', 'Đổi mật khẩu thành công.');
    }

    // Hiển thị trang đăng ký (dùng chung)
    public function showRegister()
    {
        return view('client.auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'role' => 2,
            'status' => 1,
            'remember_token' => Str::random(60),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công.');
    }

    // Hiển thị form đăng ký cho admin (chỉ admin cấp cao mới truy cập)
    public function showAdminRegister()
    {
        return view('admin.auth.register');
    }

    // Xử lý đăng ký admin (tạo user với vai trò admin)
    public function adminRegister(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role' => 'nullable|in:1,2',
        ]);

        $user = User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'role' => $data['role'] ?? 2,
            'status' => 1,
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản admin thành công.');
    }
}
