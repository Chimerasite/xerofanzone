<?php

namespace App\Livewire\Foraging;

use App\Models\ForagingLocations;
use App\Models\ForagingStats;
use App\Models\Items;

use Livewire\Component;

class Table extends Component
{

    public $massedit;

    public $id = '';
    public $name = '';
    public $value = '';
    public $color = '';
    public $type = '';
    public $start = '';
    public $end = '';

    public function add($forage) //plus 1 on item
    {
        $item = ForagingStats::find($forage['id']);
        $item->amount = $forage['amount'] + 1;
        $item->save();
    }

    public function substract($forage)  //minus 1 on item
    {
        $item = ForagingStats::find($forage['id']);

        if(!$item->amount == 0){
            $item->amount = $forage['amount'] - 1;
            $item->save();
        }
    }

    public function addItem($location) //add item to location
    {
        $exist = [];

        foreach(ForagingStats::all()->where('foraging_location_id', $location) as $forage) {
            array_push($exist, $forage->forageable->id);
        }

        if(in_array($this->id, $exist) || $this->id == null){
            $all = [];

            foreach(Items::all()->sortby('name') as $i) {
                array_push($all, $i->id);
            }

            $new = array_diff($all, $exist);

            if(in_array($this->id, $exist)) {
                $pos = array_search($this->id, $all);

                for(;!array_key_exists($pos, $new); $pos++){
                    //do nothing
                }

                $this->id = $new[$pos];
            } elseif($this->id == null) {
                $this->id = reset($new);
            }
        }

        ForagingStats::create(['foraging_location_id'=> $location, 'forageable_id' => $this->id, 'amount'=> 0]);
    }

    public function delete($forage) //delete item from location
    {
        $item = ForagingStats::find($forage['id']);
        $item->delete();
    }

    public function createItem() //create new item
    {
        if($this->value == null){
            $this->value = 0;
        }

        Items::updateOrCreate(['name'=>$this->name, 'value'=>$this->value]);
    }

    public function newLocation() //create new location
    {
        if($this->start != null && $this->end != null){
            ForagingLocations::updateOrCreate(['name'=>$this->name, 'color'=>$this->color, 'type'=>$this->type, 'start_date'=>$this->start, 'end_date'=>$this->end]);
        } else {
            ForagingLocations::updateOrCreate(['name'=>$this->name, 'color'=>$this->color, 'type'=>$this->type]);
        }

    }

    public function render()
    {
        $forages = ForagingStats::all();
        $locations = ForagingLocations::all();
        $bestVal = '';

        $vals = [];
        foreach($locations as $location){
            $calcValue = 0;
            $calcAmount = 0;

            $today = date('m-d');
            $start = substr($location->start_date, 5);
            $end = substr($location->end_date, 5);

            if(in_array($location->type, ['Standard', 'Monthly']) || ($location->type == 'Event' && ($today >= $start) && ($today <= $end) )) {
                $things = $forages->where('foraging_location_id', $location->id);

                if($things->first() != null){
                    foreach($things as $thing){
                        $calcValue += $thing->amount * $thing->item->value;
                        $calcAmount += $thing->amount;
                    }

                    if($calcAmount != null){
                        $vals += [$location->name => $calcValue/$calcAmount];
                    }
                }
            }
        }

        if(!empty($vals)){
            $bestVal = implode(", ", array_keys($vals, max($vals)));
        }

        return view('foraging.table', [
            'bestVal' => $bestVal,
            'locations' => $locations,
            'forages' => $forages->sortby('forageable.name'),
            'forageables' => Items::all()->sortby('name'),
            'updated' => $forages->sortByDesc('updated_at')->first()->updated_at ?? null,
        ]);
    }
}

