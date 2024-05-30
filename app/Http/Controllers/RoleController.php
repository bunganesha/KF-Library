<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data role', ['only' => ['index']]);
        $this->middleware('permission:tambah role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit role', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus role', ['only' => ['destroy']]);
        $this->middleware('permission:tambah role permission', ['only' => ['givePermissionvzToRole', 'addPermissionToRole']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        return view('role-permission.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role-permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10'
        ]);
        $request->validate([
            'name'=>[
                'string',
                'required',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('/role')->with('status', 'Role baru berhasi ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view ('role-permission.role.edit', compact('role'));
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
        $request->validate([
            'name' => 'required|max:10'
        ]);
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            $request->except(['_token'])
        ]);

        $request->validate([
            'name'=>[
                'string',
                'required',
                'unique:roles,name,'.$role->id
            ]
        ]);

        return redirect('/role')->with('status', 'Role berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('/role')->with('status', 'Role berhasil dihapus');
    }

    public function addPermissionToRole($id)
    {
        $permission = Permission::all();
        $role = Role::findOrFail($id);
        $rolePermission = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id')
                                ->all();
        return view('role-permission.role.addPermission', compact('role','permission','rolePermission'));
    }

    public function givePermissionToRole(Request $request, $id)
    {
        $request->validate([
            'permission'=>'required'
        ]);
        
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);
        return redirect('/role')->with('status', 'Permission berhasil ditambahkan ke Role');
    }
}
