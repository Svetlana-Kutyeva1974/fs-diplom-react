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
    public $hall, $seance, $film, $dateChosen;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($seance='', $hall='', $film='', $dateChosen='')
    {
        $this->hall = $hall;
        $this->film = $film;
        $this->seance = $seance;
        $this->dateChosen = $dateChosen;
        //$this->dateCurrent = $dateCurrent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client.hall');
    }
}
