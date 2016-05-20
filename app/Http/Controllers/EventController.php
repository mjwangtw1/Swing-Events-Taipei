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
        $event_location = [];

        //Update location here;
        $event_location = array(
                array('id' => 1,'name' => '華山木地板','address' => ''),
                array('id' => 2,'name' => '松煙木地板','address' => ''),
                array('id' => 3,'name' => '國父紀念館走廊下','address' => ''),
                array('id' => 4,'name' => '圓山 Maji Maji 集食行樂','address' => ''),
                array('id' => 5,'name' => '圓山 Traingle Bar','address' => ''),
                array('id' => 6,'name' => '圓山 花博木地板','address' => ''),
                array('id' => 7,'name' => 'USR127玩藝工廠','address' => ''),
                array('id' => 8,'name' => 'Sappho','address' => ''),
                array('id' => 9,'name' => 'TAV','address' => ''),
                array('id' => 10,'name' => 'Tangorismo','address' => ''),
                array('id' => 11,'name' => 'Corazon Tango','address' => ''),
                array('id' => 12,'name' => '台大滴咖啡','address' => ''),
                array('id' => 13,'name' => '中山堂','address' => ''),
                array('id' => 99,'name' => '其他(請務必在說明中填寫)','address' => ''),
        );

        $data['user_name'] = $this->_user['name'];
        
        return view('course.event_insert', compact('data', 'event_location'));
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

        //Here call and write to Calendar API.



        //Here write to Database (new feature)
        
    }







}
