<?php

namespace App\Livewire\Foraging;

use Livewire\Component;
use App\Models\ForagingLocations;
use App\Models\ForagingStats;
use App\Models\Items;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class ForagingUpdate extends Component
{
    public $amount;
    public $location;
    public $forageable;
    public $config, $passcode;

    public function mount()
    {
        $this->config = Config::where('data', 'upload forages')->get('value')->first()->value;
    }

    public function addItems()
    {
        if(! Auth::user()) {
            $code = Config::where('data', 'forage password')->get('value')->first()->value;
            if($this->passcode !== $code) {
                session()->flash('message', 'Incorrect Passcode');
                return;
            }
        }

        if($this->location == null){
            $this->location = ForagingLocations::all()->first()->id;
        }

        if($this->forageable == null){
            $this->forageable= Items::all()->sortby('name')->first()->id;
        }

        $existing = ForagingStats::where([
                        ['foraging_location_id', $this->location],
                        ['item_id', $this->forageable]
                    ])
                    ->first();

        if($this->amount == null || $this->amount == 0){
            if($existing == null){
                $this->amount = 1;
            } else {
                $this->amount = $existing->amount + 1;
            }
        } elseif($existing != null) {
            $this->amount = $existing->amount + $this->amount;
        }

        if($existing == null){
            ForagingStats::create(['foraging_location_id'=> $this->location, 'item_id' => $this->forageable, 'amount'=> $this->amount]);
        } else {
            $existing->update(['amount' => $this->amount]);
        }

        $this->amount = '';

        session()->flash('message', 'Forage added succesfully');
    }

    public function render()
    {
        $locations = ForagingLocations::all();

        $filteredLocations= $locations->where(function ($location) {
                $today = date('m-d');
                $start = substr($location->start_date, 5);
                $end = substr($location->end_date, 5);
                if(in_array($location->type, ['standard', 'monthly']) || ($location->type == 'event' && ($today >= $start) && ($today <= $end) )) {
                    return $location;
                }
            })->sortby(function ($location) {
                if($location->name == 'Crater') {
                    return $location;
                }
        });

        return view('foraging.foraging-update', [
            'locations' => $filteredLocations,
            'forages' => ForagingStats::all()->sortby('forageable.name'),
            'forageables' => Items::all()->where('forageable', true)->sortby('name'),
        ]);
    }
}
