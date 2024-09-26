<?php

namespace App\Livewire\Comets;

use Livewire\Component;
use App\Models\Items;
use App\Models\CometStats;

class Submit extends Component
{
    public $comet;
    public $amount;

    public function addCometStats()
    {
        if($this->comet == null){
            $this->comet = Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name')->first()->id;
        }

        CometStats::create(['item_id'=> $this->comet, 'amount'=> $this->amount]);

        $this->amount = '';

        session()->flash('message', 'Comet Cluster added succesfully');
    }

    public function render()
    {
        return view('comets.submit',[
            'cometTypes' => Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name'),
        ]);
    }
}
