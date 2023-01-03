<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public $table = 'tickets';
    protected  $fillable = [
        'qrCod',
        'count',
        'seance_id',
        'seat_id',
        'film_id',
    ];

    /**
     * Returns seances, that goes in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seance() //seance к которому относятся билеты\билет
    {
        return $this->belongsTo(Seance::class);
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
