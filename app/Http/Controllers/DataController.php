<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\GoogleCalendar; //Google calendar API
use Carbon\Carbon;               //Carbon for Time formatting

define('DEFAULT_IMAGE_HOMEPAGE', '');

class DataController extends Controller
{
    //These 4 Calendar are public so far. No Worries.
    const SWING_TAIWAN_COURSE_CALENDAR_ID = '04huqev84k4egbau4viug9q8vg@group.calendar.google.com';
    const TAIWAN_SWING_CALENDAR_REGULAR   = 'du5ncgcem4duked6jui8p1g5as@group.calendar.google.com'; //Regular Events
    const TAIWAN_SWING_CALENDAR_SPECIAL   = 'k89l8gcv9l19k5aafaolmn2d38@group.calendar.google.com'; //Special Events
    const TAIPEI_BLUES_EVENTS_CALENDAR    = 'hbcpknmo5l1jp455qdbrjps2uo@group.calendar.google.com'; //Blues Events @ Taipei

    // const BIRD_GIF_1 = 'http://2.bp.blogspot.com/-IU6NUe_3JRA/VlaQZXDDj6I/AAAAAAADOhw/ETH4ovfm8jo/s1600/8795400.gif';
    const GOOGLE_MAP_API_KEY = 'AIzaSyBY7C54J0Z2tm_OOORmDvVY0gZjeNQIvQY';

    const TAIPEI_TIMEZONE = 'Asia/Taipei';


    private $_current_time = '';
    private $_date_today = '';
    private $_date_next_week = '';

    //Use for showing event Type
    private $_event_type = 
        ['swing_regular', 'swing_special', 'blues'];

    private $_blues_file_path = '';
    private $_swing_file_path = '';
    private $_special_file_path = '';

    public function __construct()
    { 
        $this->_current_time = Carbon::now(); 

        $this->_date_today = Carbon::today();
        $this->_date_next_week = $this->_date_today->addweeks(1);
        $this->_blues_file_path = base_path() . '/_conf/blues_data.php';
        $this->_swing_file_path = base_path() . '/_conf/swing_data.php';
        $this->_special_file_path = base_path() . '/_conf/special_data.php';
    }

    public function index()
    {
        return view('home');
    }

    /**
     * Major Calendar Feature
     *
     * @return [type] [description]
     */
    public function calendar()
    {
        $calendar = new GoogleCalendar;

        $calendarId = Self::SWING_TAIWAN_COURSE_CALENDAR_ID; //Swing Taiwan Courses.
        //$calendarId = TAIWAN_SWING_CALENDAR_REGULAR; //Swing Calendar.


        //1.This one work: get calendar.
        //$data['calendar_info'] = $calendar->get($calendarId);

        //2.
        $event_info = $calendar->get_events($calendarId);

        $data['calendar_name'] = $event_info->summary;
        $data['timezone']      = $event_info->timeZone;
        $data['events']        = $event_info['modelData']['items'];

        date_default_timezone_set($event_info->timeZone);


        //Toss to events view file.
        return view('event', compact('data'));

        //return printf("Now: %s", Carbon::now());

        //$formatted_time = Carbon::createFromFormat('Y/m/d', $data['events'][0]['start']['dateTime'])->toDateTimeString();
        //$dt = Carbon::parse($data['events'][0]['start']['dateTime']);
    }




    public function course()
    {
        $calendar = new GoogleCalendar;

        $calendarId = Self::SWING_TAIWAN_COURSE_CALENDAR_ID; //Swing Taiwan Courses.

        //2.
        $event_info = $calendar->get_events($calendarId);

        $data['calendar_name'] = $event_info->summary;
        $data['timezone']      = $event_info->timeZone;
        $data['events']        = $event_info['modelData']['items'];

        date_default_timezone_set($event_info->timeZone);

        //Toss to events view file.
        return view('course', compact('data'));
    }

    //This one List specific Event with Detailed Info.
    public function event($calendarId, $eventId, $typeId)
    {   
        //Event part
        $calendar = new GoogleCalendar;
        $event = $calendar->get_unique_event($calendarId, $eventId);
        $event['type'] = $typeId;

        //List part
        $optParams = array(
          'maxResults' => 2,
          'orderBy' => 'startTime',
          'singleEvents' => TRUE,
          //'timeMin' => date('c'),
          // 'timeMin' => $this->_current_time->subdays(3)->format('c'), //This One Remove later.
          // 'timeMax' => $this->_current_time->adddays(1)->format('c'),

          'timeMin' => date('c'),
          'timeMax' => $this->_date_next_week->format('c')
        );

        //0 -> TS Regular | 1 -> TS Special | 2 -> Blues Event
        //Swing Regular Calendar
        $calendarId = Self::TAIWAN_SWING_CALENDAR_REGULAR; //Swing Calendar.
        $taiwan_swing_regular_info = $calendar->get_events($calendarId, $optParams);
        $data[0]['events']        = $taiwan_swing_regular_info['modelData']['items'];
        $data[0]['calendarId'] = Self::TAIWAN_SWING_CALENDAR_REGULAR;

        //Swing Calendar - Special
        $calendarId = Self::TAIWAN_SWING_CALENDAR_SPECIAL; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $data[1]['events']        = $taiwan_swing_special_info['modelData']['items'];
        $data[1]['calendarId'] = Self::TAIWAN_SWING_CALENDAR_SPECIAL;

        //Blues Calendar
        $calendarId = Self::TAIPEI_BLUES_EVENTS_CALENDAR; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $data[2]['events']        = $taiwan_swing_special_info['modelData']['items'];
        $data[2]['calendarId'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;

        $api_key = self::GOOGLE_MAP_API_KEY;

        return view('event_display.event_detail', compact('event', 'data', 'api_key'));
    }

    public function home() //Loads from Swing file
    {   
        //Check first: if not then regen file.
        if ( ! (is_file($this->_swing_file_path) && file_exists($this->_swing_file_path)) ) 
        {
            $this->prepare_file();
        }

        include($this->_swing_file_path); //Read the file and use the $data array right away.
        include($this->_special_file_path); //Read the special events

        $title_info = 'swing';

        return view('event_display.home', compact('data','special','title_info'));
    }

    public function blues() //This one reads blues from file directly
    {
        if ( !(is_file($this->_blues_file_path) && file_exists($this->_blues_file_path)))
        {
            $this->prepare_file();
        }
        include($this->_blues_file_path); //Read the file and use the $data array right away.
        include($this->_special_file_path); //Read the special events

        $title_info = 'blues';

        return view('event_display.home', compact('data', 'special','title_info'));
    }

    // FEATURE FUNCTIONS ====================================================================================
    // FEATURE FUNCTIONS ====================================================================================
    //Here Feature Functions
    public function prepare_file() //List events in one week.
    {
        $calendar = new GoogleCalendar;
    
        //Parameters : Events within this week 
        $optParams = array(
          'maxResults' => 40,
          'orderBy' => 'startTime',
          'singleEvents' => TRUE,
          'timeMin' => date('c'),
          'timeMax' => $this->_date_next_week->format('c')
        );

        //0 -> TS Regular | 1 -> TS Special | 2 -> Blues Event
        //Swing Regular Calendar
        $calendarId = Self::TAIWAN_SWING_CALENDAR_REGULAR; //Swing Calendar.
        $taiwan_swing_regular_info = $calendar->get_events($calendarId, $optParams);
        $data[0]['events']        = $taiwan_swing_regular_info['modelData']['items'];
        $data[0]['calendarId'] = Self::TAIWAN_SWING_CALENDAR_REGULAR;

        //Blues Calendar
        $calendarId = Self::TAIPEI_BLUES_EVENTS_CALENDAR; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $data[2]['events']        = $taiwan_swing_special_info['modelData']['items'];
        $data[2]['calendarId'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;

        //These 2 below are needed. just to export.
        $blues_data[2]['events']        = $taiwan_swing_special_info['modelData']['items'];
        $blues_data[2]['calendarId'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;


        $optParams['maxResults'] = 1; //We just fetch ONE special events;
        $optParams['timeMax'] = $this->_current_time->addweeks(5)->format('c'); //Fetch the coming 3 weeks events.    
        //Swing Calendar - Special
        $calendarId = Self::TAIWAN_SWING_CALENDAR_SPECIAL; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $special['events'] = $taiwan_swing_special_info['modelData']['items'];
        $special['calendarId'] = Self::TAIWAN_SWING_CALENDAR_SPECIAL;

        $this->_check_and_delete_static_files();

        date_default_timezone_set("Asia/Taipei");
        $gen_time = date("Y-m-d H:i:s");

        //Blues Only
        file_put_contents($this->_blues_file_path, '<!-- FILE GEN AT: ' . $gen_time .  ' --><?php $data = ' . var_export($blues_data, true) . ';');

        //Swing Files (incldes Swing and Blues)
        file_put_contents($this->_swing_file_path, '<!-- FILE GEN AT: ' . $gen_time .  ' --><?php $data = ' . var_export($data, true) . ';');

        //Special Events
        file_put_contents($this->_special_file_path, '<!-- FILE GEN AT: ' . $gen_time .  ' --><?php $special = ' . var_export($special, true) . ';');

        return 'File written at [' . $gen_time . ']';
    }

    public function check_data()
    {
        if (is_file($this->_blues_file_path) && file_exists($this->_blues_file_path))
        {
            include($this->_blues_file_path);
            var_dump($data);
        }
        else
        {
            return 'No file found!';
        }
    }

    //
    // PRIVATE FUNCTIONS ====================================================================================
    // PRIVATE FUNCTIONS ====================================================================================
    //Here Private Functions
    private function _check_and_delete_static_files()
    {
        if (is_file($this->_blues_file_path) && file_exists($this->_blues_file_path))
        {
            unlink($this->_blues_file_path); 
        }

        if (is_file($this->_swing_file_path) && file_exists($this->_swing_file_path))
        {
            unlink($this->_swing_file_path); 
        }
    }

    //MDFH use Testing::::
    public function sample()
    {
        return view('sample.layout');
    }

    public function event_detail()
    {
        return view('sample.event_detail');
    }

    //TESTING purpose.
    public function test()
    {
        //$dt = Carbon::addweeks(1);
        //return $this->_date_next_week;
        return $this->_date_next_week->format('c');
    }

    public function sam()
    {
        $img_url = '<img border="0" src="http://2.bp.blogspot.com/-IU6NUe_3JRA/VlaQZXDDj6I/AAAAAAADOhw/ETH4ovfm8jo/s1600/8795400.gif">';

        return $img_url;
    }

    public function log()
    {
        return view('logs');
    }


}