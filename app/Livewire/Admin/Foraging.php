<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ForagingLocations;

class Foraging extends Component
{
    public $locationId, $name, $color, $type, $startDate, $endDate;
    public $newName, $newColor, $newType, $newStartDate, $newEndDate;

    public function addValues()
    {
        $input = ForagingLocations::where('id', $this->locationId)->get()->first();
        if($input != null){
            $this->name = $input->name;
            $this->color = $input->color;
            $this->type = $input->type;
            $this->startDate = $input->start_date;
            $this->endDate = $input->end_date;
        } else {
            $this->reset();
        }
    }

    public function updateLocation()
    {
        if($this->name == "" || $this->color == "" || $this->type == "" ) {
            session()->flash('updateErrorMessage', 'Name, Color and Type fields Can\'t be empty');
        } elseif($input = ForagingLocations::where('id', $this->locationId)->get()->first() ==null ) {
            session()->flash('updateErrorMessage', 'Please select a location to update');
        } else {
            ForagingLocations::where('id', $this->locationId)->update([
                'name' => $this->name,
                'color' => $this->color,
                'type' => $this->type,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
            ]);

            session()->flash('updateMessage', 'Location updated succesfully');
            $this->reset();
        }
    }

    public function newLocation()
    {
        if($this->newName == "" || $this->newColor == "" || $this->newType == "" ) {
            session()->flash('newErrorMessage', 'Name, Color and Type fields Can\'t be empty');
        } else {
            ForagingLocations::create([
                'name' => $this->newName,
                'color' => $this->newColor,
                'type' => $this->newType,
                'start_date' => $this->newStartDate,
                'end_date' => $this->newEndDate,
            ]);

            session()->flash('newMessage', 'Location created succesfully');
            $this->reset();
        }
    }

    public function render()
    {
        return view('admin.partials.foraging', [
            'locations' => ForagingLocations::all(),
        ]);
    }
}
