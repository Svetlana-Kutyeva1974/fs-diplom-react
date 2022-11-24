<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';

    protected  $fillable = [
        'title',
        'description',
        'duration',
        'imagePath',
        'imageText',
        'origin',
    ];

    /**
     * Return seances with this film
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function seance()
    {
        return $this->hasMany(Seance::class, 'film_id');
        // return $this->hasMany('App\Seance');
        //return $this->belongsToMany('App\Seance', 'film_id');
    }
}
