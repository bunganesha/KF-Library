<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Lending;
use App\Models\User;
use App\Models\Shelf;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
  public function index()
  {

    $books = Book::count();
    $category = Category::count();
    $shelf = Shelf::count();
    $lending = Lending::all();

    if(Gate::allows('lihat semua data peminjaman')) {
      $lending = Lending::all();
    }
    else {
        $lending = Lending::where('id_employee', auth()->user()->id)->get();
    }

    //fiture view data per user
    $user = Auth::user();
    // dd($user);

    // fiture popular books
    $popularBooks = Book::select('books.*', DB::raw('(SELECT COUNT(*) FROM lendings WHERE lendings.id_book = books.id) as lending_count'))
    ->orderByDesc('lending_count')
    ->take(10)
    ->get();

    // fiture notification
    // $user = Auth::user();
    if ($user->position == 'admin') {
      $notifications = $user->notifications;
      $user->unreadNotifications->markAsRead();
      dd($notifications);
      return view('dashboard.admin', compact('notifications', 'books', 'popularBooks', 'shelf', 'category', 'lending'));
    } else {
      return view('home.dashboard', compact( 'books', 'popularBooks', 'shelf', 'category', 'lending'));
    }

    // $notifications = $user->unreadNotifications;
    // return view('home.dashboard', compact('book', 'books', 'popularBooks', 'shelf', 'category', 'lending'));
  }


  public function showActiveBorrower($limit = 2)
  {
    // Define a threshold for high borrow count (e.g., top borrower)
    $borrowThreshold = Lending::orderBy('id_employee', 'desc')->limit(1)->first(); // Assuming a count column in Borrow table

    $activeBorrowerIds = Lending::select('id_employee')
      ->groupBy('id_employee')
      // Replace with your logic to identify high borrow users
      ->havingRaw('COUNT(*) >= ?', [$borrowThreshold])  // Example threshold filter
      ->orderBy('id_employee', 'desc') // Or another relevant column
      ->limit($limit)
      ->pluck('id_employee');
    return view('home.dashboard', compact('activeBorrowerIds', 'borrowThreshold'));
  }
}
