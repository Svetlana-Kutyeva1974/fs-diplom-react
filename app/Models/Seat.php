<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    public $table = 'seats';
    protected  $fillable = [
        'id',
        'colNumber',
        'rowNumber',
        //'id_seance',
    ];
}
