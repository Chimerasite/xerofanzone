<?php

namespace App\Livewire\Fancreations;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\FanCreations;
use App\Models\Users;

class PostList extends Component
{
    public $posts;
    public $filtered = false;

    public function mount()
    {
        $this->posts = FanCreations::all()->where('public', true)->sortBy('updated_at');
    }

    public function myPosts()
    {
        $this->posts = FanCreations::all()->where('user_id', Auth::user()->id)->sortBy('name');
        $this->filtered = true;
    }

    public function resetFilter()
    {
        $this->posts = FanCreations::all()->where('public', true)->sortBy('updated_at');
        $this->filtered = false;
    }

    public function render()
    {
        return view('fancreations.post-list',[
            'posts' => $this->posts,
        ]);
    }
}
