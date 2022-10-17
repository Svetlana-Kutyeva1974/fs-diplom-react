<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    public $table = 'halls';
    protected  $fillable = [
        'nameHall',
        'col',
        'row',
        'countVip',
        'countNormal',
        //'id_seance',
    ];
    /**
     * Return seances in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seance()
    {
        return $this->hasMany('App\Seance', 'hall_id');
    }
    /**
     * Return seats in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seat()
    {
        return $this->hasMany('App\Seat');
    }
}
