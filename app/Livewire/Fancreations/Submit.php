<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\FanCreations;

class Submit extends Component
{
    public $name, $slug, $thumbnail, $description, $contact, $external_link, $art_permission, $writing_permission, $public;
    public $tags;
    public $tagList = [];
    public $location, $otherLocation;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addTagList()
    {
        if($this->tags != "") {
            $this->tags = ucfirst($this->tags);
            array_push($this->tagList,$this->tags);
        }
        $this->tags = "";
    }

    public function removeTagList($key)
    {
        $val = array_search($key, $this->tagList);
        if($val !== false) {
            unset($this->tagList[$val]);
        }
    }

    public function createPost()
    {
        //check if required fields are filled in and unique if needed
        if($this->name == null){
            session()->flash('errorMessage', 'Please enter a Title for your post.');
            return;
        }
        if($this->slug == null){
            session()->flash('errorMessage', 'Please enter a Slug for your post.');
            return;
        }

        if(FanCreations::where('slug', $this->slug)->first() != null){
            session()->flash('errorMessage', 'This Slug already exists.');
            return;
        }

        //make sure slug is right format
        $this->slug = Str::slug($this->slug);

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
            'tags' => $this->tagList,
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
        $allTags = FanCreations::all();
        
        return view('fancreations.submit');
    }
}
