<?php

namespace App\Livewire\Profile\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FanCreations;
use App\Models\Users;

class Posts extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = DB::table('fan_creations')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('profile.partials.posts',[
            'posts' => $this->posts,
        ]);
    }
}
