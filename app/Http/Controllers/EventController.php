<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\Course; //Use Post[Model]

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Check if LoggedIn
        $this->middleware('auth'); 
        //$this->middleware('admin');
        
        $this->_user = Auth::user();
    }


    /**
     * Insert blog Content
     *
     * @return [type] [description]
     */
    public function insert(Request $request)
    {
        var_dump($request->input());


    }


}
