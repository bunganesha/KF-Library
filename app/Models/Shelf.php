<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'shelf_name',
        'description'
    ];
    protected $table = 'shelves';
    public function Shelf(){
        return $this->hasMany(Shelf::class, 'id', 'id');
    }
}
