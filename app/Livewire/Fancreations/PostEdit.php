<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\FanCreations;
use App\Models\Locations;

class PostEdit extends Component
{
    public $post, $name, $slug, $thumbnail, $description, $contact, $art_permission, $writing_permission, $public, $location, $otherLocation, $tags;
    public $allLocations = [];
    public $tagList = [];
    public $allTags = [];
    public $external_link_name, $external_link;

    public function mount()
    {
        //assign value to basics
        $this->name = $this->post->name;
        $this->slug = $this->post->slug;
        $this->thumbnail = $this->post->thumbnail;
        $this->description = $this->post->description;
        $this->contact = $this->post->contact;
        $this->external_link_name = $this->post->external_link['name'];
        $this->external_link = $this->post->external_link['link'];
        $this->art_permission = $this->post->art_permission;
        $this->writing_permission = $this->post->writing_permission;
        $this->public = $this->post->public;

        //assign value to location
        $locations = DB::table('locations')->select('name', 'type')->orderByRaw("CASE WHEN type = 'Planet' THEN 1 WHEN type = 'Region' THEN 2 ELSE 3 END")->get();
        foreach($locations as $location) {
            array_push($this->allLocations,$location->name);
        }

        if(in_array($this->post->location, $this->allLocations)){
            $this->location = $this->post->location;
        } else {
            $this->location = 'Other';
            $this->otherLocation = $this->post->location;
        }

        //assign value to tags
        $this->tagList = $this->post->tags;

        //create list with all used tags for datalist
        $var = FanCreations::where('public', true)->get('tags');

        foreach($var as $key) {
            if($key->tags) {
                foreach($key->tags as $tag) {
                    if(! in_array($tag, $this->allTags) && $tag != "") {
                        array_push($this->allTags,$tag);
                    }
                }
            }
        }
    }

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

    public function addImageField()
    {
        dd('wieh');
    }

    public function updatePost()
    {
        //check if required fields are filled in and unique if needed
        if(! $this->name){
            session()->flash('errorMessage', 'Please enter a Title for your post.');
            return;
        }

        if(! $this->slug){
            session()->flash('errorMessage', 'Please enter a Slug for your post.');
            return;
        }

        if(FanCreations::where('slug', $this->slug)->where('id', '!=', $this->post->id)->first() != null){
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

        FanCreations::where('id', $this->post->id)->update([
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
            'external_link' => ['name' => $this->external_link_name, 'link' => $this->external_link],
        ]);

        session()->flash('postMessage', 'Post updated succesfully');
    }

    public function render()
    {
        return view('fancreations.post-edit');
    }
}
