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
        'imagePath'
        //'id_seance',
    ];

    /**
     * Return seances with this film
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function seance()
    {
        return $this->hasMany('App\Seance', 'film_id');
        // return $this->hasMany('App\Seance');
    }
}
