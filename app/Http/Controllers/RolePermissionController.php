<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
     public function index($roleId)
     {
 
    $permissions = Permission::all();
        $rolePermissions = Role::findOrFail($roleId)->permissions;

        if (count($rolePermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('active', false);
                foreach ($rolePermissions as $rolePermission) {
                    if ($rolePermission->id == $permission->id) {
                        $permission->active = true;
                    }
                }
            }
        }

        return response()->view('cms.spaity.role.role-permission', ['roleId' => $roleId, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $roleId)
    {
      

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $roleId)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|exists:permissions,id',
        ]);
    
        if (!$validator->fails()) {
            $role = Role::findOrFail($roleId);
            $permission = Permission::findOrFail($request->permission_id);
    
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
    
            // امسح الكاش عشان التغيير يظهر فوراً
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    
            return response()->json(['icon' => 'success', 'title' => 'تم التحديث'], 200);
        }
    
        return response()->json(['message' => $validator->errors()->first()], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
