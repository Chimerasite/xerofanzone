<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForagingController extends Controller
{
    public function Index()
    {
        return view('foraging.index');
    }

    public function Edit()
    {
        return view('foraging.edit');
    }

    public function Update()
    {
        return view('foraging.update');
    }
}
