<?php

namespace App\Livewire\Comets;

use Livewire\Component;
use App\Models\Items;
use App\Models\CometStats;

class Table extends Component
{
    public function render()
    {
        return view('comets.table', [
            'cometTypes' => Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name'),
            'cometStats' => CometStats::all(),
        ]);
    }
}
