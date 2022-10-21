<?php

namespace App\View\Components\Client;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use Illuminate\View\Component;

class Card extends Component
{
    public $alt, $src, $title, $synopsis, $duration, $origin;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($alt , $src, $synopsis, $title,$origin, $duration, Hall $hall,Film $film, Seance $seance )
    {
        //dump($film);
        $this->alt = $alt;
        $this->src = $src;
        $this->synopsis = $synopsis;
        $this->title = $title;
        $this->origin = $origin;
        $this->duration = $duration;
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
