<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    public $table = 'halls';
    protected  $fillable = [
        'id',
        'col',
        'row',
        //'id_seance',
    ];
    /**
     * Return seances in this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seances()
    {
        return $this->hasMany('App\Seance');
    }
}
