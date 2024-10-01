<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FanCreations;

class FanCreationController extends Controller
{
    public function Index()
    {
        return view('fancreations.index', [
            'posts' => FanCreations::all(),
        ]);
    }

    public function Show(string $slug)
    {
        $post = FanCreations::where('slug', $slug)->first();

        return view('fancreations.show', [
            'post' => $post,
            'images' => $post->images,
        ]);
    }

    public function Create()
    {
        return view('fancreations.create');
    }

    public function Edit()
    {
        //
    }

    public function Destroy()
    {
        //
    }
}
