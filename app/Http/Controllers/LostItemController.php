<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    public function index()
    {
        return view('lost_items.index');
    }

    public function edit()
    {
        return view('lost_items.edit');
    }

    public function update()
    {
        return view('lost_items.update');
    }
}
