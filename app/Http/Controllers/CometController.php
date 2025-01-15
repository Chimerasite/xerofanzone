<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CometController extends Controller
{
    public function index()
    {
        return view('comets.index');
    }

    public function update()
    {
        return view('comets.update');
    }

    public function math()
    {
        return view('comets.math');
    }
}
