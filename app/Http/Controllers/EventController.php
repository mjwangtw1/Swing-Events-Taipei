<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\Course; //Use Post[Model]

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Services\GoogleCalendar; //Google calendar API
use Carbon\Carbon;               //Carbon for Time formatting

class EventController extends Controller
{
    const SWING_TAIWAN_COURSE_CALENDAR_ID = '04huqev84k4egbau4viug9q8vg@group.calendar.google.com';
    const TAIWAN_SWING_CALENDAR_REGULAR   = 'du5ncgcem4duked6jui8p1g5as@group.calendar.google.com'; //Regular Events
    const TAIWAN_SWING_CALENDAR_SPECIAL   = 'k89l8gcv9l19k5aafaolmn2d38@group.calendar.google.com'; //Special Events
    const TAIPEI_BLUES_EVENTS_CALENDAR    = 'hbcpknmo5l1jp455qdbrjps2uo@group.calendar.google.com'; //Blues Events @ Taipei

    const GOOGLE_MAP_API_KEY = 'AIzaSyBY7C54J0Z2tm_OOORmDvVY0gZjeNQIvQY';

    const TAIPEI_TIMEZONE = 'Asia/Taipei';
    const PASS_CODE = 'bibi';

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
    public function new_event()
    {
        $event_location = [];

        //Update location here;
        $event_location = array(
                array('id' => 1,'name' => '華山木地板','address' => '100台北市中正區八德路一段1號'),
                array('id' => 2,'name' => '松煙木地板','address' => ' 110台北市信義區光復南路133號'),
                array('id' => 3,'name' => '國父紀念館走廊下','address' => '110台北市信義區仁愛路四段505號'),
                array('id' => 4,'name' => '圓山 Maji Maji 集食行樂','address' => '104台北市中山區玉門街1號'),
                array('id' => 5,'name' => '圓山 Triangle Bar','address' => '104台北市中山區玉門街1號'),
                array('id' => 6,'name' => '圓山 花博木地板','address' => '104台北市中山區玉門街1號'),
                array('id' => 7,'name' => 'USR127玩藝工廠','address' => '103台北市大同區迪化街一段127號號'),
                array('id' => 8,'name' => 'Sappho Live Jazz','address' => '106台北市大安區安和路一段102巷1號'),
                array('id' => 9,'name' => 'TAV','address' => '100台北市中正區北平東路7號'),
                array('id' => 10,'name' => 'Tangorismo','address' => '106台北市大安區忠孝東路四段169號之4'),
                array('id' => 11,'name' => 'Corazon Tango','address' => '106復興南路一段92-9號'),
                array('id' => 12,'name' => '台大滴咖啡','address' => ' 106台北市大安區羅斯福路四段1號台大體育館二樓'),
                array('id' => 13,'name' => '中山堂','address' => '100台北市中正區延平南路98號'),
                array('id' => 14,'name' => '西雅圖咖啡世貿旗艦店','address' => '110台北市信義區信義路五段6號'),

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
        $calendarId = Self::TAIWAN_SWING_CALENDAR_REGULAR;

        $data['event_name'] = $request->input('event_name');
        $data['dance_style'] = $request->input('dance_style');
        $data['special_event_flag'] = $request->input('is_special_event');
        $data['location'] = $request->input('location');
        $data['location_type'] = $request->input('location_type');
        
        $data['event_link'] = $request->input('event_link');
        $data['event_desc'] = $request->input('event_desc');
        $data['event_tags'] = $request->input('event_tags');
        
        $event_length = $request->input('event_length');

        $data['event_submitter'] = $this->_user['name'];

        $date_time = strtotime($request->input('event_time')); //Convert to UNIX time
        $date_time = date("Y-m-d\TH:i:sP", $date_time); //Format to Google time

        $end_time = strtotime($request->input('event_time') . " + $event_length hours");
        $end_time = date('Y-m-d\TH:i:sP', $end_time);

        $data['event_time'] = $date_time;
        $data['event_end_time'] = $end_time;

        $passcode = $request->input('passcode');

        //Block this just avoid BOT injection.
        if (Self::PASS_CODE != $passcode)
        {
            echo 'Wrong passcode! Try again.';

            return back();
        }


        if (2 == $data['dance_style'])
        {
            $calendarId = Self::TAIPEI_BLUES_EVENTS_CALENDAR;
        }

        //Switch calendar - Override if special event.
        if ( ! is_null($data['special_event_flag']) && 1 == $data['special_event_flag'])
        {
            $calendarId = Self::TAIWAN_SWING_CALENDAR_SPECIAL;
        } 

        // var_dump($passcode);
        // exit();

        //Here call and write to Calendar API.
        //$result = $this->insert_to_calendar($calendarId, $data);

        return $result->eventId;
    }

    public function insert_to_calendar($calendarId = '', $data = '')
    {
        $calendar = new GoogleCalendar;

        //Sample time format: //2016-05-21T09:00:00-07:00

        $event_detail = array(
          'summary' => $data['event_name'],
          'location' => $data['location'],
          'description' => $data['event_desc'],
          'start' => array(
            'dateTime' => $data['event_time'],
            //'timeZone' => self::TAIPEI_TIMEZONE,
          ),
          'end' => array(
            'dateTime' => $data['event_end_time'],
            //'timeZone' => self::TAIPEI_TIMEZONE,
          ),
          'recurrence' => array(
            // 'RRULE:FREQ=DAILY;COUNT=2'
          ),
          'attendees' => array(
            // array('email' => 'lpage@example.com'),
            // array('email' => 'sbrin@example.com'),
          ),
          // 'reminders' => array(
          //   'useDefault' => FALSE,
          //   'overrides' => array(
          //     array('method' => 'email', 'minutes' => 24 * 60),
          //     array('method' => 'popup', 'minutes' => 10),
          //   ),
          'creator' => array(
            'id' => 'mou_the_badger'
          ),
        );

        return $calendar->insert($calendarId, $event_detail);
    }



    public function delete_event_from_calendar()
    {
        $calendar = new GoogleCalendar;

        $calendarId = Self::TAIWAN_SWING_CALENDAR_REGULAR;
        $eventId = 'aeq4n0tg5bcm3vs9qkjl7r53r0';

        $result = $calendar->delete($calendarId, $eventId);

        return $result;
    }   






}
