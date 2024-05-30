<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data permission', ['only' => ['index']]);
        $this->middleware('permission:tambah permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit permission', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission=Permission::all();
        return view('role-permission.permission.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role-permission.permission.create');
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
            'name' => 'required|max:30'
        ]);
        $request->validate([
            'name'=>[
                'string',
                'required',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('/permission')->with('status', 'Permission baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view ('role-permission.permission.edit', compact('permission'));
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
            'name' => 'required|max:30'
        ]);
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
            $request->except(['_token'])
        ]);

        // $request->validate([
        //     'name'=>[
        //         'string',
        //         'required',
        //         'unique:permissions,name'
        //     ]
        // ]);

        return redirect('/permission')->with('status', 'Permission berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('/permission')->with('status', 'Permission berhasil dihapus');
    }
}
