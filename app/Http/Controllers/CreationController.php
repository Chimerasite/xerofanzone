<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FanCreations;

class CreationController extends Controller
{
    public function Index()
    {
        return view('creations.index');
    }

    public function Show(string $id)
    {
        return view('creations.show', [
            'post' => FanCreations::findOrFail($id)
        ]);
    }

    public function Create()
    {
        //
    }

    public function Edit()
    {
        //
    }

    public function Destroy()
    {
        //
    }
}
