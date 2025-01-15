<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Items as Item;

class Items extends Component
{
    public $itemId, $name, $value, $forageable;
    public $newName, $newValue, $newForageable;

    public function addValues()
    {
        $input = Item::where('id', $this->itemId)->get()->first();
        if($input != null){
            $this->name = $input->name;
            $this->value = $input->value;
            $this->forageable = $input->forageable;
        } else {
            $this->reset();
        }
    }

    public function updateItem()
    {
        if($this->forageable == "") {
            $this->forageable = 1;
        } elseif($this->name == "" || $this->forageable == "" ) {
            session()->flash('updateErrorMessage', 'Name and Forageable fields Can\'t be empty');
        } elseif($input = Item::where('id', $this->itemId)->get()->first() ==null ) {
            session()->flash('updateErrorMessage', 'Please select an item to update');
        } else {
            Item::where('id', $this->itemId)->update([
                'name' => $this->name,
                'value' => $this->value,
                'forageable' => $this->forageable,
            ]);

            session()->flash('updateMessage', 'Item updated succesfully');
            $this->reset();
        }
    }

    public function newItem()
    {
        if($this->newForageable == "") {
            $this->newForageable = 1;
        } elseif($this->newName == "" || $this->newForageable == "" ) {
            session()->flash('newErrorMessage', 'Name and Forageable fields Can\'t be empty');
        } else {
            Item::create([
                'name' => $this->newName,
                'value' => $this->newValue,
                'forageable' => $this->newForageable,
            ]);

            session()->flash('newMessage', 'Item created succesfully');
            $this->reset();
        }
    }

    public function render()
    {
        return view('admin.partials.items', [
            'items' => Item::all(),
        ]);
    }
}
