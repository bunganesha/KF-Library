<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotificationInterface;

class Lending extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id_employee',
        'id_book',
        'loan_date',
        'return_date',
        'loan_limit',
        'status'
    ];
    protected $table = 'lendings';
    public function Lending(){
        return $this->hasMany(Lending::class, 'id', 'id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'id_employee', 'id');
    }
    public function Book(){
        return $this->belongsTo(Book::class, 'id_book', 'id');
    }
}
