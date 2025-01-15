<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin.show', [
            'role' => Role::all(),
            'menu' => 'settings',
        ]);
    }
}
