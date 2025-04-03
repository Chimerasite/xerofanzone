<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index()
    {
        return view('containers.index');
    }

    public function edit()
    {
        return view('containers.edit');
    }

    public function update()
    {
        return view('containers.update');
    }
}
