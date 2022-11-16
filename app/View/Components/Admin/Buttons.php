<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Buttons extends Component
{
    public $hall, $seance, $dateChosen, $film, $seats, $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($seats='', $hall='', $seance='', $film='',  $dateChosen='', $selected=[])
    {
        $this->hall = $hall;
        $this->film = $film;
        $this->seance = $seance;
        $this->dateChosen = $dateChosen;
        $this->seats = $seats;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.buttons');
    }
}
