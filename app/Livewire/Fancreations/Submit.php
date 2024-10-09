<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\FanCreations;

class Submit extends Component
{
    public $name, $slug, $thumbnail, $tags, $description, $contact, $external_link, $art_permission, $writing_permission, $public;
    public $location, $otherLocation;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function createPost()
    {
        //make sure slug is right format
        $this->slug = Str::slug($this->slug);

        //turn tags string into array
        $tagsArray = explode( ', ', $this->tags );

        //when using other location add comment
        if($this->location == 'Other'){
            $this->location = $this->otherLocation;
        }

        //permissions set to true is null
        if($this->art_permission == null){
            $this->art_permission = 'yes';
        }
        if($this->writing_permission == null){
            $this->writing_permission = 'yes';
        }

        //public false when null
        if($this->public == null){
            $this->public = false;
        }

        FanCreations::create([
            'user_id' => Auth::User()->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'tags' => $tagsArray,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'location' => $this->location,
            'art_permission' => $this->art_permission,
            'writing_permission' => $this->writing_permission,
            'public' => $this->public,
            'contact' => $this->contact,
            'external_link' => $this->external_link,
        ]);

        session()->flash('postMessage', 'Post added succesfully');
        $this->reset();
    }

    public function render()
    {
        return view('fancreations.submit');
    }
}
