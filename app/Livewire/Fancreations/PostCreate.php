<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\FanCreations;
use App\Models\Config;
use Livewire\Attributes\On;

class PostCreate extends Component
{
    public $name, $slug, $thumbnail, $description, $contact, $art_permission, $writing_permission, $public;
    public $location, $otherLocation;
    public $allLocations = [];
    public $tags;
    public $tagList = [];
    public $allTags = [];
    public $external_link_name, $external_link;
    public $linkedCount = 1;
    public $linkedList = [];
    public $imageCount = 1;
    public $imageList = [];
    public $imgText;
    public $imgLink = [];
    public $imgInfo;
    public $config = 1;

    public function mount()
    {
        $locations = DB::table('locations')->select('name', 'type')->orderByRaw("CASE WHEN type = 'Planet' THEN 1 WHEN type = 'Region' THEN 2 ELSE 3 END")->get();
        foreach($locations as $location) {
            array_push($this->allLocations,$location->name);
        }

        $this->linkedList += [$this->linkedCount => ['name' => '', 'thumbnail' => '', 'link' => '', 'role' => '']];

        $this->imageList += [$this->imageCount => ['text' => '', 'image' => '', 'info' => '']];

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

        $this->config = Config::where('data', 'create posts')->get('value')->first()->value;
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

    public function addLinkedField()
    {
        $this->linkedCount ++;

        if (array_key_exists($this->linkedCount, $this->linkedList)) {
            $this->linkedCount ++;
        }

        $this->linkedList += [$this->linkedCount => ['name' => '', 'thumbnail' => '']];
    }

    public function removeLinkedField($key)
    {
        $this->linkedCount --;

        $item;

        if (array_key_exists($key, $this->linkedList)) {
            unset($this->linkedList[$key]);
        }
    }

    #[On('saveLinkedName')]
    public function saveLinkedName($newName, $key)
    {
        $item;

        if(array_key_exists($key, $this->linkedList)) {
            $this->linkedList[$key]['name'] = $newName;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    #[On('saveLinkedRole')]
    public function saveLinkedRole($newRole, $key)
    {
        $item;

        if(array_key_exists($key, $this->linkedList)) {
            $this->linkedList[$key]['role'] = $newRole;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    #[On('saveLinkedThumbnail')]
    public function saveLinkedThumbnail($newThumbnail, $key)
    {
        $item;

        if(array_key_exists($key, $this->linkedList)) {
            $this->linkedList[$key]['thumbnail'] = $newThumbnail;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    #[On('saveLinkedLink')]
    public function saveLinkedLink($newLink, $key)
    {
        $item;

        if(array_key_exists($key, $this->linkedList)) {
            $this->linkedList[$key]['link'] = $newLink;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    public function addImageField()
    {
        $this->imageCount ++;

        if (array_key_exists($this->imageCount, $this->imageList)) {
            $this->imageCount ++;
        }

        $this->imageList += [$this->imageCount => ['text' => '', 'image' => '']];
    }

    public function removeImageField($key)
    {
        $this->imageCount --;

        $item;

        if (array_key_exists($key, $this->imageList)) {
            unset($this->imageList[$key]);
        }
    }

    #[On('saveImageText')]
    public function saveImageText($newText, $key)
    {
        $item;

        if(array_key_exists($key, $this->imageList)) {
            $this->imageList[$key]['text'] = $newText;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    #[On('saveImageLink')]
    public function saveImageLink($newLink, $key)
    {
        $item;

        if(array_key_exists($key, $this->imageList)) {
            $this->imageList[$key]['image'] = $newLink;
        } else {
            //dont do anything this shouldnt ever happen
        }
    }

    #[On('saveImageInfo')]
    public function saveImageInfo($newInfo, $key)
    {
        $item;

        if(array_key_exists($key, $this->imageList)) {
            $this->imageList[$key]['info'] = $newInfo;
        } else {
            //dont do anything this shouldnt ever happen
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
            'external_link' => ['name' => $this->external_link_name, 'link' => $this->external_link],
            'linked_characters' => $this->linkedList,
            'images' => $this->imageList
        ]);

        session()->flash('postMessage', 'Post added succesfully');
        $this->reset();
    }

    public function render()
    {
        return view('fancreations.post-create');
    }
}
