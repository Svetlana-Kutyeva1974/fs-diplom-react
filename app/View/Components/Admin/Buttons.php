<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Buttons extends Component
{
    public $hall, $seance, $dateChosen, $film, $seats, $selected_hall, $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $disabled='false', $seats='', $hall='', $seance='', $film='',  $dateChosen='', $selected_hall='1')
    {
        $this->disabled = $disabled;
        $this->hall = $hall;
        $this->film = $film;
        $this->seance = $seance;
        $this->dateChosen = $dateChosen;
        $this->seats = $seats;
        $this->selected_hall = $selected_hall;
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
