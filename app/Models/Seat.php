<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    public $table = 'seats';
    protected  $fillable = [
        'type',
        'free',
        'colNumber',
        'rowNumber',
        'hall_id',
    ];
    /**
     * Returns the hall where is the seat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall()
    {
        return $this->belongsTo('App\Hall');
    }
}
