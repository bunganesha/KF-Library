<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shelf;

class ShelfController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data rak', ['only' => ['index']]);
        $this->middleware('permission:tambah rak', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit rak', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus rak', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelf = Shelf::all();
        return view('home.shelf.index', compact('shelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.shelf.create');
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
            'shelf_name' => 'required|max:10',
            'description' => 'required|string|max:100'
        ]);
        Shelf::create([
            'shelf_name'=>$request->shelf_name,
            'description'=>$request->description
        ]);
        return redirect('/shelf')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shelf = Shelf::find($id);
        return view('home.shelf.edit', compact('shelf'));
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
            'shelf_name' => 'required|max:10',
            'description' => 'required|string|max:150'
        ]);
        $shelf = Shelf::find($id);
        $shelf->update([
            'shelf_name'=>$request->shelf_name,
            'description'=>$request->description,
            $request->except(['_token'])
        ]);
        return redirect('/shelf')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shelf = Shelf::find($id);
        $shelf -> delete();
        return redirect('/shelf')->with('status', 'Data berhasil dihapus');
    }
}
