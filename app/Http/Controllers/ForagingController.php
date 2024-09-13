<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForagingController extends Controller
{
    public function foragingShow()
    {
        return view('foraging.show');
    }

    public function foragingEdit()
    {
        return view('foraging.edit');
    }

    public function foragingAdd()
    {
        return view('foraging.add');
    }
}
