<?php

namespace App\Livewire\Comets;

use Livewire\Component;
use App\Models\Items;
use App\Models\CometStats;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class CometsUpdate extends Component
{
    public $comet;
    public $amount;
    public $config, $passcode;

    public function mount()
    {
        $this->config = Config::where('data', 'upload comets')->get('value')->first()->value;
    }

    public function addCometStats()
    {
        if(! Auth::user()) {
            $code = Config::where('data', 'forage password')->get('value')->first()->value;
            if($this->passcode !== $code) {
                session()->flash('message', 'Incorrect Passcode');
                return;
            }
        }

        if($this->comet == null){
            $this->comet = Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name')->first()->id;
        }

        CometStats::create(['item_id'=> $this->comet, 'amount'=> $this->amount]);

        $this->amount = '';

        session()->flash('message', 'Comet Cluster added succesfully');
    }

    public function render()
    {
        return view('comets.comets-update',[
            'cometTypes' => Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name'),
        ]);
    }
}
