<?php

namespace App\Http\Controllers;

use App\Models\Visitors; // Ensure you're importing the Visitors model
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function display()
    {
        $visitors = Visitors::all();
        
        return view('display', compact('visitors'));
    }
}