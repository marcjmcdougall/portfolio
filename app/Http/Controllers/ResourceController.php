<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        return view('resources.index');
    }
    public function clarityCall()
    {
        return view('resources.clarity-call');
    }

    public function teardown()
    {
        return view('resources.teardown');
    }

    public function freeCourse()
    {
        return view('resources.free-course');
    }

    public function functional()
    {
        return view('resources.functional');
    }
}
