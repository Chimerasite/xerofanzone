<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FanCreations;
use App\Models\Locations;
use App\Models\Users;
use App\Models\Role;

class FanCreationController extends Controller
{
    public function index()
    {
        return view('fancreations.index', [
            'posts' => FanCreations::all(),
        ]);
    }

    public function show(string $slug)
    {
        $post = FanCreations::where('slug', $slug)->first();
        $post->tags = implode( ', ', $post->tags );
        $location = Locations::where('name', $post->location)->select('name', 'link')->first();
        $adminRole = Role::where('is_admin', 1)->get('edit_posts')->first()->edit_posts;
        $modRole = Role::where('is_admin', 2)->get('edit_posts')->first()->edit_posts;

        return view('fancreations.show', [
            'post' => $post,
            'linkedCharacters' => $post->linked_characters,
            'images' => $post->images,
            'location' => $location,
            'adminRole' => $adminRole,
            'modRole' => $modRole,
        ]);
    }

    public function create()
    {
        return view('fancreations.create');
    }

    public function edit(string $slug)
    {
        return view('fancreations.edit', [
            'post' => FanCreations::where('slug', $slug)->first(),
        ]);
    }

    public function destroy()
    {
        //
    }
}
