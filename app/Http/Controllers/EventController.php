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

        $data['event_name'] = $request->input('event_name');
        $data['dance_style'] = $request->input('dance_style');
        $data['special_event_flag'] = $request->input('is_special_event');
        $data['location'] = $request->input('location');
        $data['location_type'] = $request->input('location_type');
        $data['event_time'] = $request->input('event_time');
        $data['event_link'] = $request->input('event_link');
        $data['event_desc'] = $request->input('event_desc');
        $data['event_tags'] = $request->input('event_tags');

        $data['event_submitter'] = $this->_user['name'];


        

    }







}
