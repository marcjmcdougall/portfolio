<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function calculator()
    {
        // Just return the view - it will contain the Livewire component
        return view('tools.calculator');
    }
}
