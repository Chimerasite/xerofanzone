<?php

namespace App\Livewire\Lostitems;

use Livewire\Component;
use App\Models\LostItemStats;
use App\Models\Items;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class LostitemsUpdate extends Component
{
    public $amount;
    public $lostItemType;
    public $recievedItem;
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
                $this->dispatch('incorrect-password');
                return;
            }
        }

        if($this->lostItemType == null){
            $this->lostItemType = Items::where('name', 'like','%Lost %')->get()->sortbydesc('name')->first()->id;
        }

        if($this->recievedItem == null){
            $this->recievedItem= Items::all()->sortby('name')->first()->id;
        }

        $existing = LostItemStats::where([
                        ['lost_item_id', $this->lostItemType],
                        ['item_id', $this->recievedItem]
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
            LostItemStats::create(['lost_item_id'=> $this->lostItemType, 'item_id' => $this->recievedItem, 'amount'=> $this->amount]);
        } else {
            $existing->update(['amount' => $this->amount]);
        }

        $this->amount = '';

        $this->dispatch('lostItems-added');
    }

    public function render()
    {
        return view('lost_items.lostitems-update', [
            'lostItemTypes' => Items::where('name', 'like','%Lost %')->get()->sortbydesc('name'),
            'lostItemStats' => LostItemStats::all(),
            'items'=> Items::all()->sortby('name'),
        ]);
    }
}
