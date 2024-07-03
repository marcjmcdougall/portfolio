<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function clarityCall()
    {
        return view('resources.clarity-call');
    }
}
