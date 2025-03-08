<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('role.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = DB::table('permissions')->get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'permissions' => 'required|array|min:1', // Bắt buộc phải có ít nhất 1 quyền được chọn
        ], [
            'permissions.required' => 'Bạn phải chọn ít nhất một quyền.',
            'permissions.min' => 'Bạn phải chọn ít nhất một quyền.',
        ]);

        // Lấy danh sách permissions đã chọn
        $selectedPermissions = $validateData['permissions'];

        // Tạo role mới (chỉ lấy title)
        $role = Role::create([
            'title' => $validateData['title'],
        ]);

        // Cập nhật quyền cho role (nếu có bảng trung gian role_permission)
        $role->permissions()->sync($selectedPermissions);

        return redirect()->route('role');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = DB::table('roles')->find($id);
        $permissions = DB::table('permissions')->get();

        $permissions_role = DB::table('permission_role')
            ->where('role_id', $id) // Lọc theo role_id
            ->pluck('permission_id'); // Lấy danh sách ID của permissions thuộc role
        // Lấy thằng này == thằng $permission

        return view('role.edit', compact('role', 'permissions', 'permissions_role'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lấy danh sách quyền được chọn (nếu không có thì là mảng rỗng)
        $selectedPermissions = $request->input('permissions', []);

        // Xóa tất cả quyền hiện tại của role
        DB::table('permission_role')->where('role_id', $id)->delete();

        // Nếu có quyền được chọn, thêm lại vào bảng permission_role
        if (!empty($selectedPermissions)) {
            $data = [];
            foreach ($selectedPermissions as $permissionId) {
                $data[] = [
                    'role_id' => $id,
                    'permission_id' => $permissionId
                ];
            }
            DB::table('permission_role')->insert($data);
        }

        return redirect()->route('role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
