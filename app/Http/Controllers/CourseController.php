<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\Course; //Use Post[Model]


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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

    }

    /**
     * Display new course insert interface.
     *
     * @return [type] [description]
     */
    public function new_course()
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
        //get the data from ajax POST
        $course_title    = $request->input('course_title');
        $course_teacher  = $request->input('course_teacher');
        $course_level    = $request->input('course_level');
        $course_location = $request->input('course_location');
        $course_price    = $request->input('course_price');
       
        $course_link     = $request->input('course_link');
        $course_date     = $request->input('course_date');
        $course_desc     = $request->input('course_desc');
        $course_user     = $request->input('course_group');

        //Here Write into Database;
        $course = new Course;

        $course->title    = $course_title;
        $course->teacher  = $course_teacher;
        $course->level    = $course_level;
        $course->location = $course_location;
        $course->price    = $course_price;
        
        $course->link = $course_link;
        $course->date = $course_date;
        $course->desc = $course_desc;
        $course->user = $course_user;
        $course->flag = TRUE;

        $course->save();
        
        return $course;
    }
}
