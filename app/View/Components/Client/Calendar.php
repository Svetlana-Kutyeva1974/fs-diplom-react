<?php

namespace App\View\Components\Client;

use Illuminate\View\Component;

class Calendar extends Component
{
    public $halls, $seances, $dateCurrent, $dateChosen, $films;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($halls='', $seances='', $films='', $dateCurrent='', $dateChosen='')
    {
        $this->halls = $halls;
        $this->films = $films;
        $this->seances = $seances;
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
        return view('components.client.calendar');
    }
}
