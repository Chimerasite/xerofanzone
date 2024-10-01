<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;

class Submit extends Component
{
    public function createPost()
    {
        dd('test');
    }

    public function render()
    {
        return view('fancreations.submit');
    }
}
