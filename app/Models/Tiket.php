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
        'qrCod',
        //'id_seance',
        //'id_seat',
        //'id_film',
    ];

    /**
     * Returns seances, that goes in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seance()
    {
        return $this->belongsTo('App\Seance');
    }

    /**
     * Return characteristik seat of this tiket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seat()
    {
        return $this->belongsTo('App\Seat');
    }
}
