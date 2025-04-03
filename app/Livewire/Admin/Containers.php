<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Containers as Container;
use App\Models\Items;

class Containers extends Component
{
    public $containerId, $name, $itemId, $type, $split, $active;
    public $newName, $newItemId, $newType, $newSplit, $newActive;

    public function addValues()
    {
        $input = Container::where('id', $this->containerId)->get()->first();

        if($input->splits == null) {
            $input->splits = [];
        }

        if($input != null){
            $this->name = $input->name;
            $this->itemId = $input->item_id;
            $this->type = $input->type;
            $this->split = implode(", ", $input->splits);
            $this->active = $input->active;
        } else {
            $this->reset();
        }
    }

    public function updateContainer()
    {
        $splits = explode(", ", $this->split);

        if($this->type == "") {
            $this->type = 'items';
        }

        if($this->split == "") {
            $this->split = '[]';
        }

        if($this->name == "" ) {
            session()->flash('updateErrorMessage', 'Container field Can\'t be empty');
        }

        Container::where('id', $this->containerId)->update([
            'name' => $this->name,
            'item_id' => $this->itemId,
            'type' => $this->type,
            'splits' => $splits,
            'active' => $this->active,
        ]);

        session()->flash('updateMessage', 'Container updated succesfully');

        $this->reset();

    }

    public function newContainer()
    {
        $splits = explode(", ", $this->split);


        if($this->newType == "") {
            $this->newType = 'items';
        } if($splits == "") {
            $splits = [];
        } if($this->newActive == "") {
            $this->newActive = 1;
        } if($this->newName == "") {
            session()->flash('newErrorMessage', 'Name field Can\'t be empty');
            dd('test');
        }

        Container::create([
            'name' => $this->newName,
            'item_id' => $this->newItemId,
            'type' => $this->newType,
            'splits' => $splits,
            'active' => $this->newActive,
        ]);

        session()->flash('newMessage', 'Container created succesfully');
        $this->reset();
    }

    public function render()
    {
        return view('admin.partials.containers', [
            'containers' => Container::all(),
            'items' => Items::all()->sortby('name'),
        ]);
    }
}
