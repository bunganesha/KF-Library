<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Book;
use App\Models\User;
use App\Notifications\LendingNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class LendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat data peminjaman', ['only' => ['index']]);
        $this->middleware('permission:tambah peminjaman', ['only' => ['create', 'store']]);
        $this->middleware('permission:hapus peminjaman', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('lihat semua data peminjaman')) {
            $lending = Lending::all();
        }
        else {
            $lending = Lending::where('id_employee', auth()->user()->id)->get();
        }
        return view('home.lending.index', compact('lending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = Book::all();
        $employee = User::all();
        return view('home.lending.create', compact('book', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan_date = Carbon::now();
        $loan_limit = Carbon::now()->addDays(7);

        $book = Book::findOrFail($request->id_book);
        if ($book->stock > 0) {
            $book->stock--;
            $book->save();
        } else {
            // Jika stok buku kosong, munculkan pesan kesalahan
            return redirect('/lending')->with('error', 'Stok buku tidak mencukupi.');
        }
        $lending = Lending::create([
            'id_employee' => $request->id_employee,
            'id_book' => $request->id_book,
            'loan_date' => $loan_date,
            'return_date' => $request->return_date,
            'loan_limit' => $loan_limit
        ]);

        //NOTIFIKASI
        // $admin = User::where('position', 1)->first();
        
        if(auth()->user()->position == 1) {
            $admin = User::find(auth()->user()->id);
            $admin->notify(new LendingNotification($lending));
        }
        return redirect('/lending')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::all();
        $employee = User::all();
        $lending = Lending::find($id);
        return view('home.lending.edit', compact('book', 'employee', 'lending'));
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
        $lending = Lending::find($id);
        $lending->update([
            'id_employee' => $request->id_employee,
            'id_book' => $request->id_book,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
            'loan_limit' => $request->loan_limit,
            'status' => $request->status,
            $request->except(['_token'])
        ]);
        return redirect('/lending')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lending = Lending::find($id);
        $lending->delete();
        return redirect('/lending')->with('status', 'Data berhasil dihapus');
    }

    public function status(Request $request, $id)
    {
        $return_date = Carbon::now();
        $data = Lending::where('id', $id)->first();

        if ($data->status == 1) {
            $data->update([
                'status' => 0,
                'return_date' => $return_date
            ]);
            $book = Book::findOrFail($data->id_book);
            $book->stock++;
            $book->save();
        }
        return redirect('/lending')->with('status', 'Status berhasil diubah');
    }
}
