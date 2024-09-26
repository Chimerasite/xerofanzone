<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CometController extends Controller
{
    public function Show()
    {
        return view('comets.show');
    }

    public function Add()
    {
        return view('comets.add');
    }

    public function Math()
    {
        return view('comets.math');
    }
}
