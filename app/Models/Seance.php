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
    public function hall()
    {
        return $this->belongsTo('App\Hall');
    }


    /**
     * Return all tickets of this seance
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }
}
