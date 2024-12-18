<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Locations as Location;

class Locations extends Component
{
    public $locationId, $name, $link, $type;
    public $newName, $newLink, $newType;

    public function addValues()
    {
        $input = Location::where('id', $this->locationId)->get()->first();
        if($input != null){
            $this->name = $input->name;
            $this->link = $input->link;
            $this->type = $input->type;
        } else {
            $this->reset();
        }
    }

    public function updateLocation()
    {
        if($this->name == "" || $this->link == "" || $this->type == "" ) {
            session()->flash('updateErrorMessage', 'Fields Can\'t be empty');
        } elseif($input = Location::where('id', $this->locationId)->get()->first() ==null ) {
            session()->flash('updateErrorMessage', 'Please select a location to update');
        } else {
            Location::where('id', $this->locationId)->update([
                'name' => $this->name,
                'link' => $this->link,
                'type' => $this->type,
            ]);

            session()->flash('updateMessage', 'Location updated succesfully');
            $this->reset();
        }
    }

    public function newLocation()
    {
        if($this->newName == "" || $this->newLink == "" || $this->newType == "" ) {
            session()->flash('newErrorMessage', 'Fields Can\'t be empty');
        } else {
            Location::create([
                'name' => $this->newName,
                'link' => $this->newLink,
                'type' => $this->newType,
            ]);

            session()->flash('newMessage', 'Location created succesfully');
            $this->reset();
        }
    }

    public function render()
    {
        return view('admin.locations', [
            'locations' => Location::all(),
        ]);
    }
}
