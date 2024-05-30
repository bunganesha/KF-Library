<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shelf;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data kategori', ['only' => ['index']]);
        $this->middleware('permission:tambah kategori', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit kategori', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus kategori', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::all();
        return view('home.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelf=Shelf::all();
        return view('home.category.create', compact('shelf'));
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
            'description' => 'required|string|max:150'
        ]);
        Category::create([
            'id_shelf'=>$request->id_shelf,
            'description'=>$request->description
        ]);
        return redirect('/category')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shelf=Shelf::all();
        $category=Category::find($id);
        return view('home.category.edit', compact('category', 'shelf'));
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
            'description' => 'required|string|max:150'
        ]);
        $category=Category::find($id);
        $category->update([
            'id_shelf'=>$request->id_shelf,
            'description'=>$request->description,
            $request->except(['_token'])
        ]);
        return redirect('/category')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect('/category')->with('status', 'Data berhasil dihapus');
    }
}
