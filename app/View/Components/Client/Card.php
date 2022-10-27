<?php

namespace App\View\Components\Client;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use Illuminate\View\Component;
use stdClass;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toJSON;

class Card extends Component
{
    public $alt, $src, $title, $synopsis, $duration, $origin, $halls, $seance, $film, $hh, $ss;
    //public $rel= (array) null;
    //public $rel= (object) null;
    //public $rel= (array) null;
    public $seances;
    /*public $rel= (object) [
        "id" => "Foo value",
        "startSeance" => "Bar value"
    ];*///new stdClass();(object)[] эквивалентно new stdClass().
    //public $rel= null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($seances,   $ss='', $hh='', $alt , $src, $synopsis, $title, $origin, $duration, $halls="", $film='', $seance='' )
    {
       // dump($hh);
        //dump($ss);
        //dump($rel);
        //var_dump($seances);
        //var_dump($halls);
        //dump($film);
        $this->alt = $alt;
        $this->src = $src;
        $this->synopsis = $synopsis;
        $this->title = $title;
        $this->origin = $origin;
        $this->duration = $duration;
        $this->halls = $halls;
        $this->film = $film;
        $this->seance = $seance;
        $this->hh = $hh;
        $this->ss = $ss;
        //$this->rel = $rel;
        $this->seances = $seances;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client.card');
    }
}
