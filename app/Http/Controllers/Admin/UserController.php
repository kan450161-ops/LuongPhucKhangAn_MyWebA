<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        $list = User::select('userid', 'fullname', 'username', 'email', 'role', 'status')
            ->orderBy('fullname')
            ->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // query builder
        // DB::table('users')->insert([
        //     'fullname' => $request->fullname,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        // Eloquent ORM
        // User::create([
        //     'fullname' => $request->fullname,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return redirect()->route('admin.users.index');

        try {
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'role' => $request->role,
                'birthday' => $request->birthday,
                'status' => $request->status,
                'remember_token' => Str::random(60),
            ]);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Thêm Người Dùng thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Thêm Người dùng thất bại! Lỗi: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Show User with id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::find($id);
        $user = User::find($id, ['*']);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {

            // $user = User::find($id);
            $user = User::find($id, ['*']);

            if (! $user) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // thực hiện cập nhật sản phẩm
            $user->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'role' => $request->role,
                'birthday' => $request->birthday,
                'status' => $request->status,
                'remember_token' => Str::random(60),
            ]);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Cập nhật Danh mục thành công');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::findOrFail($id)->delete();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Xóa người dùng thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    // hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
    public function trash($limit = 10)
    {
        $list = User::onlyTrashed()
            ->select('userid', 'fullname', 'username', 'email', 'role', 'status')
            ->orderBy('fullname')
            ->paginate($limit);

        return view('admin.users.trash', compact('list'));
    }
   // khôi phục dữ liệu đã xóa
    public function restore($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->restore();

            return redirect()
                ->route('admin.users.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục thất bại.');
        }
    }

    // xóa vĩnh viễn
    public function forceDelete($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->forceDelete();

            return redirect()
                ->route('admin.users.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa thất bại.');
        }
    }
}
