<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    public $table = 'seances';
    protected  $fillable = [
        'timeSeance',
        //'id_film',
        //'id_hall',
    ];

    /**
     * Returns the film - shows on this seance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function films()
    {
        return $this->belongsTo('App\Film','id','film_id');
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
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
