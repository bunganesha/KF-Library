<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_shelf',
        'description'
    ];
    protected $table = 'categories';
    public function Category() {
        return $this->hasMany(Category::class, 'id', 'id');
    }
    public function Shelf() {
        return $this->belongsTo(Shelf::class, 'id_shelf', 'id');
    }
}
