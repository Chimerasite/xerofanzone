<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FanCreations;
use App\Models\Users;
use App\Models\Locations;

class PostIndex extends Component
{
    public $allPosts, $posts;

    public $order = 'sortByDesc';
    public $orderKey = 'created_at';

    public $name;

    public $allTags = [];
    public $tagList = [];
    public $tagFilter = [];
    public $tagSearch;

    public $allLocations = [];
    public $locationFilter = [];

    public $artFilter = [];
    public $writingFilter = [];

    public $filtered = false;

    public function mount()
    {
        $this->allPosts = DB::table('fan_creations')->where('public', true)->get();

        $this->posts = DB::table('fan_creations')->where('public', true)->orderBy('created_at', 'desc')->get();

        $locations = DB::table('locations')->select('name', 'type')->orderByRaw("CASE WHEN type = 'Planet' THEN 1 WHEN type = 'Region' THEN 2 ELSE 3 END")->get();
        foreach($locations as $location) {
            array_push($this->allLocations,$location->name);
        }

        foreach($this->allPosts as $post){
            if($post->tags != '[]'){
                $post->tags = str_replace(['[', ']', '"'], '', $post->tags);
                $post->tags = explode(", ", $post->tags);
                $this->allTags = array_merge($this->allTags, $post->tags);
            }
        }
        sort($this->allTags);
        $this->allTags = array_unique($this->allTags);
        $this->tagList = $this->allTags;
    }

    public function myPosts()
    {
        $this->posts = DB::table('fan_creations')->where('user_id', Auth::user()->id)->orderBy('name')->get();
        $this->filtered = true;
    }

    public function resetFilter()
    {
        $this->posts = DB::table('fan_creations')->where('public', true)->orderBy('created_at', 'desc')->get();
        $this->filtered = false;
        $this->order = 'sortByDesc';
        $this->orderKey = 'created_at';
        $this->name  = "";
        $this->tagFilter  = [];
        $this->locationFilter  = [];
        $this->artFilter  = [];
        $this->writingFilter = [];
    }

    public function orderBy($key, $order)
    {
        $this->posts = $this->posts->$order($key);
        $this->order = $order;
        $this->orderKey = $key;
    }

    public function filterTags()
    {
        $input = preg_quote($this->tagSearch, '~');
        $results = preg_grep('~' . $input . '~i', $this->allTags);
        $this->tagList = $results;
    }

    public function filterPosts()
    {
        if($this->order == 'sortByDesc') {
            $order = 'desc';
        } else {
            $order = 'asc';
        }

        $filters = [];
        if(! empty($this->name) || $this->name != "") {
            $filters += ['name' => $this->name];
            $this->filtered = true;
        } if(! empty($this->tagFilter)) {
            $filters += ['tags' => $this->tagFilter];
            $this->filtered = true;
        } if(! empty($this->locationFilter)) {
            $filters += ['location' => $this->locationFilter];
            $this->filtered = true;
        } if(! empty($this->artFilter)) {
            $filters += ['art_permission' => $this->artFilter];
            $this->filtered = true;
        } if(! empty($this->writingFilter)) {
            $filters += ['writing_permission' => $this->writingFilter];
            $this->filtered = true;
        }

        $listing = DB::table('fan_creations')->where('public', true)->orderBy($this->orderKey, $order);
        foreach($filters as $key=>$filter){
            if($key == 'name') {
                $listing->where($key, 'LIKE', '%'.$filter.'%');
            } elseif($key == 'tags') {
                $listing->whereJsonContains('tags', $filter);
            } else{
                $listing->whereIn($key, $filter);
            }
        }

        $result = $listing->get();

        $this->posts = $result;
    }

    public function render()
    {
        return view('fancreations.post-index',[
            'posts' => $this->posts,
        ]);
    }
}
