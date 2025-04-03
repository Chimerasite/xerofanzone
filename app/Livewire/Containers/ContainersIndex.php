<?php

namespace App\Livewire\Containers;

use Livewire\Component;
use App\Models\Config;
use App\Models\Items;
use App\Models\Containers;
use App\Models\ItemContainerStats;
use App\Models\CurrencyContainerStats;

class ContainersIndex extends Component
{
    public $config, $massedit;
    public $id = '';
    public $name, $item, $type, $split;

    public $splits;

    public function mount()
    {
        $this->config = Config::where('data', 'upload containers')->get('value')->first()->value;
    }

    public function add($loot) //plus 1 on item
    {
        $item = ItemContainerStats::find($loot['id']);
        $item->amount = $loot['amount'] + 1;
        $item->save();
    }

    public function substract($loot)  //minus 1 on item
    {
        $item = ItemContainerStats::find($loot['id']);

        if(!$item->amount == 0){
            $item->amount = $loot['amount'] - 1;
            $item->save();
        }
    }

    public function delete($loot) //delete item from container
    {
        $item = ItemContainerStats::find($loot['id']);
        $item->delete();
    }

    public function addItem($container) //add item to container
    {
        $exist = [];

        foreach(ItemContainerStats::all()->where('lost_item_id', $container) as $loot){
            array_push($exist, $loot->item->id);
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

        ItemContainerStats::create(['container_id'=> $container, 'item_id' => $this->id, 'amount'=> 0]);
    }

    public function deleteContainer($container) //delete container
    {
        $container = Containers::find($container['id']);
        $container->delete();

        $stats1 = ItemContainerStats::all()->where('container_id', $container['id']);

        foreach($stats1 as $stat1){
            $stat1->delete();
        }

        $stats2 = CurrencyContainerStats::all()->where('container_id', $container['id']);

        foreach($stats2 as $stat2){
            $stat2->delete();
        }
    }

    public function newContainer() //create new container
    {
        if($this->type == null) {
            $this->type = 'items';
        } if($this->split == "") {
            $this->split = [];
        }

        $this->split = explode(", ", $this->split);

        Containers::updateOrCreate(['name'=>$this->name, 'item_id'=>$this->item, 'type'=>$this->type, 'splits'=> $this->split]);
    }

    public function render()
    {
        return view('containers.containers-index', [
            'containers' => Containers::all(),
            'itemStats' => ItemContainerStats::orderBy('item_id'),
            'currencyStats' => CurrencyContainerStats::all(),
            'items' => Items::all()->sortby('name'),
        ]);
    }
}
