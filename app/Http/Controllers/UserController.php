<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('user_access')) {
            return view('content.pages.pages-misc-error');
        }

        $users = DB::table('users')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->can('user_create')) {
            return view('content.pages.pages-misc-error');
        }
        $roles = DB::table('roles')->get(); // Lấy tất cả roles
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash mật khẩu
        ]);
        if ($request->has('role_id')) {
            $user->role_id = $request->input('role_id');
            $user->save();
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user()->can('user_edit')) {
            return view('content.pages.pages-misc-error');
        }
        $user = User::findOrFail($id); // Lấy thông tin user
        $roles = DB::table('roles')->get(); // Lấy tất cả roles
        $user_role = $user->role_id; // Lấy role_id của user

        return view('user.edit', compact('user', 'roles', 'user_role'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            "name" => 'required|string',
            "email" => 'required',
        ]);
        $user = User::find($id);
        $user->update($validateData);
        // // Nếu có role_id trong request thì cập nhật, nếu không có thì giữ nguyên
        if ($request->has('role_id')) {
            $user->role_id = $request->input('role_id');
            $user->save();
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->can('user_delete')) {
            return view('content.pages.pages-misc-error');
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
