<?php

namespace App\Livewire\Containers;

use Livewire\Component;
use App\Models\Config;
use App\Models\Items;
use App\Models\Containers;
use App\Models\ItemContainerStats;
use App\Models\CurrencyContainerStats;
use Illuminate\Support\Facades\Auth;

class ContainersUpdate extends Component
{
    public $config, $passcode;
    public $container, $loot, $amount;
    public $containerType;

    public function mount()
    {
        $this->config = Config::where('data', 'upload containers')->get('value')->first()->value;
        $this->containerType = Containers::all()->sortby('name')->first()->type ?? '';
    }

    public function updatedContainer()
    {
        $type = Containers::find($this->container)->type;
        $this->containerType = $type;
    }

    public function addContainerStats()
    {
        if(! Auth::user()) {
            $code = Config::where('data', 'forage password')->get('value')->first()->value;
            if($this->passcode !== $code) {
                $this->dispatch('incorrect-password');
                return;
            }
        }

        if($this->container == null){
            $this->container = Containers::all()->sortby('name')->first()->id;
        }

        $container = Containers::find($this->container);

        if($container->type == 'items') {
            if($this->loot == null){
                $this->loot = Items::all()->sortby('name')->first()->id;
            }

            $existing = ItemContainerStats::where([
                ['container_id', $this->container],
                ['item_id', $this->loot]
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
                ItemContainerStats::create(['container_id'=> $this->container, 'item_id' => $this->loot, 'amount'=> $this->amount]);
            } else {
                $existing->update(['amount' => $this->amount]);
            }
        } elseif($container->type == 'currency') {
            CurrencyContainerStats::create(['container_id'=> $this->container, 'amount'=> $this->amount]);
        }

        unset($this->amount);

        $this->dispatch('loot-added');
    }

    public function render()
    {
        return view('containers.containers-update', [
            'containers' => Containers::all()->sortby('name'),
            'items' => Items::all()->sortby('name'),
        ]);
    }
}
