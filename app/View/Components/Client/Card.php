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
    public $halls, $seances, $film;
    //public $rel= (array) null;
    //public $rel= (object) null;
    //public $rel= (array) null;
    //public $seance;
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
    public function __construct($seances='', $halls="", $film='')
    {
       // dump($hh);
        //dump($ss);
        //dump($rel);
        //var_dump($seances);
        //var_dump($halls);
        //dump($film);
        //$this->alt = $alt;
        //$this->src = $src;
        //$this->synopsis = $synopsis;
        //$this->title = $title;
        //$this->origin = $origin;
        //$this->duration = $duration;
        $this->halls = $halls;
        $this->film = $film;
        $this->seances = $seances;
        //$this->seance = $seance;
        //$this->hh = $hh;
        //$this->ss = $ss;
        //$this->rel = $rel;

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
