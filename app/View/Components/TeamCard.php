<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TeamCard extends Component
{
    public $nama;
    public $jabatan;
    public $foto;
    public $email;

    /**
     * Create a new component instance.
     */
    public function __construct($nama = '', $jabatan = '', $foto = null, $email = '')
    {
        $this->nama = $nama;
        $this->jabatan = $jabatan;
        $this->foto = $foto;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.team-card');
    }
}
