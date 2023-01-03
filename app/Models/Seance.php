<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    public $table = 'seances';
    protected  $fillable = [
        'startSeance',
        'film_id',
        'hall_id',
    ];

    /**
     * Returns the film - shows on this seance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film()
    {
        //return $this->belongsTo('App\Film','id','film_id');
        //return $this->belongsTo(Film::class,'hall_id','film_id');
        return $this->belongsTo(Film::class);
        //return $this->belongsTo(Film::class, 'film_id','id');
    }

    /**
     * Returns the hall, in which than film plays
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall()// зал, в котором идут сеансы // по конкретному сеансу можно получить зал!
    {
        return $this->belongsTo(Hall::class);
    }


    /**
     * Return all tickets of this seance
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()// все билеты к сеансу
    {
        //return $this->hasMany('App\Ticket');
        return $this->hasMany(Ticket::class);
    }

    public function seats()//все места к сеансу
    {
        //return $this->hasMany('App\Seance', 'hall_id');
        return $this->hasMany(Seat::class);
    }

}
