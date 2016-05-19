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

    public function index()
    {

        $data['user_name'] = $this->_user['name'];

        return view('course.event_manage', compact('data'));

        //return $userId = Auth::user();
    }


    /**
     * Display new course insert interface.
     *
     * @return [type] [description]
     */
    public function new()
    {
        $data['user_name'] = $this->_user['name'];
        
        return view('course.event_insert', compact('data'));
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
