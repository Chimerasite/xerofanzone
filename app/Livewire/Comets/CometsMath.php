<?php

namespace App\Livewire\Comets;

use Livewire\Component;
use App\Models\CometStats;
use App\Models\Items;

class CometsMath extends Component
{
    public $minimum = "0";
    public $maximum = "0";
    public $average = "0";

    public $small = '';
    public $medium = '';
    public $large = '';

    public function calculate()
    {
        $cometStats = CometStats::all();
        $comets = Items::where('name', 'like','%Comet Cluster%')->get()->sortbydesc('name');

        $calcMin = 0;
        $calcMax = 0;
        $calcAvg = 0;

        foreach($comets as $key => $comet){
            $size = strtolower(strtok($comet->name, " "));
            if($this->$size != ""){
                //calculate minimum
                $calcMin = $calcMin + $cometStats->where('item_id', $comet->id)->sortby('amount')->first()->amount * $this->$size;

                //calculate maximum
                $calcMax = $calcMax + $cometStats->where('item_id', $comet->id)->sortbydesc('amount')->first()->amount * $this->$size;

                //calculate average
                $total = count($cometStats->where('item_id', $comet->id));
                $count = 0;
                foreach($cometStats->where('item_id', $comet->id) as $stat){
                    $count = $count + $stat->amount;
                }
                $calcAvg = $calcAvg + (round($count / $total) * $this->$size);
                $total = 0;
            }
        }

        $this->minimum = $calcMin;
        $this->maximum = $calcMax;
        $this->average = $calcAvg;

        $this->small = '';
        $this->medium = '';
        $this->large = '';
    }

    public function render()
    {
        return view('comets.comets-math');
    }
}
