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
    public $posts;
    public $allLocations = [];
    public $filtered = false;

    public function mount()
    {
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
    }

    public function orderBy($key, $order)
    {
        $this->posts = $this->posts->$order($key);
    }

    public function filter($key, $order)
    {
        $this->posts = $this->posts->$order($key);
    }

    public function render()
    {
        return view('fancreations.post-index',[
            'posts' => $this->posts,
        ]);
    }
}
