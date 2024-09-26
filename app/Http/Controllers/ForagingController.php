<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForagingController extends Controller
{
    public function Show()
    {
        return view('foraging.show');
    }

    public function Edit()
    {
        return view('foraging.edit');
    }

    public function Add()
    {
        return view('foraging.add');
    }
}
