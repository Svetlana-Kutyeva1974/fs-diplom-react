<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    public $table = 'halls';
    /**
     * @var mixed
     */
    protected  $fillable = [
        'nameHall',
        'col',
        'row',
        'countVip',
        'countNormal',
        'open',
        'typesOfSeats',
    ];
    /**
     * Return seances in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seances()
    {
        //return $this->hasMany('App\Seance', 'hall_id');
        return $this->hasMany(Seance::class);
    }
    /**
     * Return seats in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seat()
    {
        //return $this->hasMany('App\Seat', 'hall_id');
        return $this->hasMany(Seat::class);
    }
}
