<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    // This page controller sets Static pages. Which is not updated frequently.
    
    //About Page: this is about info page
    public function about()
    {
        return view('about');
    }

    //Teacher Info
    public function teacher()
    {
        return view('teacher');
    }
}
