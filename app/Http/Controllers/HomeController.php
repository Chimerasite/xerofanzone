<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FanCreations;

class HomeController extends Controller
{
    public function show()
    {
        $posts = FanCreations::inRandomOrder()->where('public', 1)->get()->toArray();
        $featured = [];

        for ($i = 0; $i <= 2; $i++) {
            if($posts != []) {
                $randomItem = array_rand( $posts );
                $featItem = [];
                $featItem += [$posts[$randomItem]];
                array_splice($posts, $randomItem, 1);

                $featured = array_merge($featured, $featItem);
            }
        }

        return view('home', [
            'featured' => $featured,
        ]);
    }
}
