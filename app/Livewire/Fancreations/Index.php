<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use App\Models\FanCreations;

class Index extends Component
{
    public function render()
    {
        return view('fancreations.index', [
            'post' => FanCreations::all(),
        ]);
    }
}
