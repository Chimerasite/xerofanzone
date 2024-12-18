<?php

namespace App\Livewire\Comets;

use Livewire\Component;
use App\Models\Items;
use App\Models\CometStats;
use App\Models\Config;

class Table extends Component
{
    public $config;

    public function mount()
    {
        $this->config = Config::where('data', 'upload comets')->get('value')->first()->value;
    }

    public function render()
    {
        return view('comets.table', [
            'cometTypes' => Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name'),
            'cometStats' => CometStats::all(),
        ]);
    }
}
