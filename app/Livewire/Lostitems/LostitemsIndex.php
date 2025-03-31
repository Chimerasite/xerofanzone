<?php

namespace App\Livewire\Lostitems;

use Livewire\Component;
use App\Models\Items;
use App\Models\LostItemStats;
use App\Models\Config;

class LostitemsIndex extends Component
{
    public $config, $massedit;

    public $id = '';

    public function mount()
    {
        $this->config = Config::where('data', 'upload comets')->get('value')->first()->value;
    }

    public function add($recievedItem) //plus 1 on item
    {
        $item = LostItemStats::find($recievedItem['id']);
        $item->amount = $recievedItem['amount'] + 1;
        $item->save();
    }

    public function substract($recievedItem)  //minus 1 on item
    {
        $item = LostItemStats::find($recievedItem['id']);

        if(!$item->amount == 0){
            $item->amount = $recievedItem['amount'] - 1;
            $item->save();
        }
    }

    public function addItem($lostItemType) //add item to lost item type
    {
        $exist = [];

        foreach(LostItemStats::all()->where('lost_item_id', $lostItemType) as $recievedItem){
            array_push($exist, $recievedItem->item->id);
        }

        if(in_array($this->id, $exist) || $this->id == null){
            $all = [];

            foreach(Items::all()->sortby('name') as $i) {
                array_push($all, $i->id);
            }

            $new = array_diff($all, $exist);

            if(in_array($this->id, $exist)) {
                $pos = array_search($this->id, $all);

                $this->id = $new[$pos];
            } elseif($this->id == null) {
                $this->id = reset($new);
            }
        }

        LostItemStats::create(['lost_item_id'=> $lostItemType, 'item_id' => $this->id, 'amount'=> 0]);
    }

    public function delete($recievedItem) //delete item from lost item type
    {
        $item = LostItemStats::find($recievedItem['id']);
        $item->delete();
    }

    public function render()
    {
        return view('lost_items.lostitems-index', [
            'lostItemTypes' => Items::where('name', 'like','%Lost %')->get()->sortbydesc('name'),
            'lostItemStats' => LostItemStats::all(),
            'items'=> Items::all()->sortby('name'),
        ]);
    }
}
