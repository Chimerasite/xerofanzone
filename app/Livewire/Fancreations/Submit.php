<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Str;

class Submit extends Component
{
    public $name, $slug;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function createPost()
    {
        dd('test');
    }

    public function render()
    {
        return view('fancreations.submit');
    }
}
