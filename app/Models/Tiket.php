<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    public $table = 'tickets';
    protected  $fillable = [
        'count',
        //'id_seance',
        //'id_seat',
        //'id_film',
    ];

    /**
     * Returns seances, that goes in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seances()
    {
        return $this->belongsTo('App\Seance');
    }

}
