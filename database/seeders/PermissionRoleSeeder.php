<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $roles = Role::pluck('id')->toArray();
        // $permissions = Permission::pluck('id')->toArray();

        // foreach ($roles as $role) {
        //     foreach ($permissions as $permission) {
        //         DB::table('permission_role')->insert([
        //             'role_id' => $role,
        //             'permission_id' => $permission
        //         ]);
        //     }
        // }

        // Lấy danh sách role
        $roles = Role::pluck('id', 'title')->toArray(); // ['Admin' => 1, 'User' => 2, 'Supper Admin' => 3]
        $permissions = Permission::pluck('id', 'title')->toArray(); // ['user_access' => 1, 'user_create' => 2, ...]

        // Quy định quyền cho từng Role
        $rolePermissions = [
            'Supper Admin' => ['user_access', 'user_create', 'user_edit', 'user_delete'], // Full quyền
            'Admin' => ['user_access', 'user_edit'], // Chỉ có quyền truy cập và chỉnh sửa
            'User' => ['user_access'], // Chỉ có quyền truy cập
        ];

        // Gán quyền theo role
        foreach ($rolePermissions as $roleTitle => $permissionsList) {
            $roleId = $roles[$roleTitle] ?? null;

            if ($roleId) {
                foreach ($permissionsList as $permissionTitle) {
                    $permissionId = $permissions[$permissionTitle] ?? null;

                    if ($permissionId) {
                        DB::table('permission_role')->insert([
                            'role_id' => $roleId,
                            'permission_id' => $permissionId,
                        ]);
                    }
                }
            }
        }
    }
}
