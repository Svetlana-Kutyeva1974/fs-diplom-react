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
    public $halls, $seances, $film, $seats, $dateChosen, $dateCurrent;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($seances='', $seats='', $halls='', $film='', $dateChosen='', $dateCurrent='')
    {
        $this->halls = $halls;
        $this->film = $film;
        $this->seances = $seances;
        $this->seats = $seats;
        $this->dateChosen = $dateChosen;
        $this->dateCurrent = $dateCurrent;
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
