<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data pegawai', ['only' => ['index']]);
        $this->middleware('permission:tambah pegawai', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit pegawai', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus pegawai', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=User::all();
        $role = Role::all();
        return view('home.employee.index', compact('employee', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('home.employee.create', compact('role'));
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
            'npp' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'position' => 'required',
        ]);
        $employee = User::create([
            'npp'=>$request->npp,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'position'=>$request->position
        ]);

        $employee->roles()->sync($request->position);
        return redirect('/employee')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::all();
        $employee=User::find($id);
        return view('home.employee.edit', compact('employee', 'role'));
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
            'npp' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255|unique:users,email',
            // 'password' => 'required|string|min:8|max:20',
            'position' => 'required',
        ]);

        $checkEmail = User::where('email', $request->email)->where('id', '!=', $id)->get();

        if($checkEmail->count()) {
            $request->validate(['email' => 'required|email|max:255|unique:users,email']);
        }

        $employee=User::find($id);

        $employee->update([
            'npp'=>$request->npp,
            'name'=>$request->name,
            'email'=>$request->email,
            // 'password'=>bcrypt($request->password),
            'position'=>$request->position,
            $request->except(['_token'])
        ]);

        if ($request->password) {
            $employee['password'] = bcrypt($request->password);
        }
        $employee->roles()->sync($request->position);
        return redirect('/employee')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=User::find($id);
        $employee->delete();
        return redirect('/employee')->with('status', 'Data berhasil dihapus');
    }
}
