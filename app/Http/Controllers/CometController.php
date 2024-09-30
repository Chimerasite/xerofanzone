<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CometController extends Controller
{
    public function Index()
    {
        return view('comets.index');
    }

    public function Update()
    {
        return view('comets.update');
    }

    public function Math()
    {
        return view('comets.math');
    }
}
