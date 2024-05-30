<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'isbn', 
        'id_category', 
        'title', 
        'writer',
        'publisher',
        'publication_year',
        'summary',
        'stock'
    ];
    protected $table = 'books';
    public function Book(){
        return $this->hasMany(Book::class, 'id', 'id');
    }
    public function Category(){
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }
}
