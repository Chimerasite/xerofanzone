<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForagingController extends Controller
{
    public function index()
    {
        return view('foraging.index');
    }

    public function edit()
    {
        return view('foraging.edit');
    }

    public function update()
    {
        return view('foraging.update');
    }
}
