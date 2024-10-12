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
    }

    public function orderBy($key, $order)
    {
        $this->posts = $this->posts->$order($key);
        $this->order = $order;
        $this->orderKey = $key;
    }

    public function filterPosts()
    {
        if($this->order == 'sortByDesc') {
            $order = 'orderByDesc';
        } else {
            $order = 'orderBy';
        }
        $key = $this->orderKey;

        $filters = [];
        if(! empty($this->name) || $this->name != "") {
            array_push($filters, ['name' => $this->name]);
        } if(! empty($this->locationFilter)) {
            array_push($filters, ['location' => $this->locationFilter]);
        } if(! empty($this->artFilter)) {
            array_push($filters, ['art_permission' => $this->artFilter]);
        } if(! empty($this->writingFilter)) {
            array_push($filters, ['writing_permission' => $this->writingFilter]);
        }

        dd($filters);

        if(! empty($this->locationFilter)){
            $this->posts = DB::table('fan_creations')->where('public', true)->$order($key)->whereIn('location', $this->locationFilter)->get();
        } elseif($this->name || $this->name != "") {
            $this->posts = DB::table('fan_creations')->where('public', true)->$order($key)->where('name', 'LIKE', '%'.$this->name.'%')->get();
        }else {
            $this->posts = DB::table('fan_creations')->where('public', true)->$order($key)->get();
        }
    }

    public function checkFilters()
    {
        dd($this->locationFilter, $this->name, $this->order, $this->orderKey, $this->artFilter);
    }

    public function render()
    {
        return view('fancreations.post-index',[
            'posts' => $this->posts,
        ]);
    }
}
