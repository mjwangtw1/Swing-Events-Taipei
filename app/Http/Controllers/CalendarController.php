<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CalendarController extends Controller
{
    //
    //
    public function index()
    {   
        return view('calendar');
    }
    
}
