<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data buku', ['only' => ['index']]);
        $this->middleware('permission:tambah buku', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit buku', ['only' => ['update', 'show']]);
        $this->middleware('permission:hapus buku', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book=Book::all();
        return view('home.book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        return view('home.book.create', compact('category'));
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
            'isbn' => 'required|max:10',
            'title' => 'required|string|max:50',
            'writer' => 'required|max:50',
            'publisher' => 'required|string|max:20',
            'publication_year' => 'required',
            'stock' => 'required|integer',
            'summary' => 'required',
        ]);

        Book::create([
            'isbn'=>$request->isbn,
            'id_category'=>$request->id_category,
            'title'=>$request->title,
            'writer'=>$request->writer,
            'publisher'=>$request->publisher,
            'publication_year'=>$request->publication_year,
            'summary'=>$request->summary,
            'stock'=>$request->stock
        ]);
        return redirect('/book')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::all();
        $book=Book::find($id);
        return view('home.book.edit', compact('book', 'category'));
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
            'isbn' => 'required|max:10',
            'title' => 'required|string|max:50',
            'writer' => 'required|max:50',
            'publisher' => 'required|string|max:20',
            'publication_year' => 'required',
            'stock' => 'required|integer',
            'summary' => 'required',
        ]);
        $book=Book::find($id);
        $book->update([
            'isbn'=>$request->isbn,
            'id_category'=>$request->id_category,
            'title'=>$request->title,
            'writer'=>$request->writer,
            'publisher'=>$request->publisher,
            'publication_year'=>$request->publication_year,
            'summary'=>$request->summary,
            'stock'=>$request->stock,
            $request->except(['_token'])
        ]);
        return redirect('/book')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        $book->delete();
        return redirect('/book')->with('status', 'Data berhasil dihapus');
    }
}
