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

    const WEATHER_API_ID = 'F-C0032-001';

    private $_cal ; //Calendar Array;

    private $_current_time = '';
    private $_date_today = '';
    private $_date_next_week = '';

    //Use for showing event Type
    private $_event_type = 
        ['swing_regular', 'swing_special', 'blues'];

    private $_blues_file_path = '';
    private $_swing_file_path = '';
    private $_special_file_path = '';
    private $_event_file_path = '';

    private $_conf_data_path = '';
    private $_conf_data = '';

    public function __construct()
    { 
        $this->_current_time = Carbon::now(); 

        $this->_date_today = Carbon::today();
        $this->_date_next_week = $this->_date_today->addweeks(1);

        $this->_blues_file_path = base_path() . '/_conf/blues_data.php';
        $this->_swing_file_path = base_path() . '/_conf/swing_data.php';
        $this->_special_file_path = base_path() . '/_conf/special_data.php';
        $this->_event_file_path = base_path() . '/_conf/event_data.php';

        $this->_conf_data_path = base_path() . '/_conf/conf_data.php';

        //Init the Cal list.
        $this->_cal['Special'] = Self::TAIWAN_SWING_CALENDAR_SPECIAL;
        $this->_cal['Swing'] = Self::TAIWAN_SWING_CALENDAR_REGULAR;
        $this->_cal['Blues'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;

        if(file_exists($this->_conf_data_path))
        {
            include_once($this->_conf_data_path);
            $this->_conf_data = $conf_data;
        }

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

    public function event_n($event_type, $eventId)
    {
        //$this->_check_and_delete_static_files(); //Delete first
        $this->prepare_file(); //newly created event -> Force Refresh.
        return $this->event($event_type, $eventId);
    }

    //This one List specific Event with Detailed Info.
    public function event($event_type, $eventId)
    {   
        $event_detail = $this->_fetch_rebuild_event($event_type, $eventId);

        //New Method: Load File as well...0 -> TS Regular | 1 -> TS Special | 2 -> Blues Event
        $event_num = 2;

        if ( ! (is_file($this->_swing_file_path) && file_exists($this->_swing_file_path)) ) 
        {
            $this->prepare_file();
        }

        include_once($this->_swing_file_path); //this one has both Swing and blues 
        
        //Swing part
        $data['0']['events'] = array_slice($data['0']['events'], 0, $event_num);
        $data['0']['calendarId'] = $data['0']['calendarId'];

        //Blues part
        $data['2']['events'] = array_slice($data['2']['events'], 0, $event_num);
        $data['2']['calendarId'] = $data['2']['calendarId'];

        //Special part
        include_once($this->_special_file_path);

        $data['1']['events'] = array_slice($special['events'], 0, $event_num);
        $data['1']['calendarId'] = $special['calendarId'];

        $api_key = self::GOOGLE_MAP_API_KEY;

        return view('event_display.event_detail', compact('event_detail', 'data', 'api_key'));
    }

    public function home() //Loads from Swing file
    {   
        //Check first: if not then regen file.
        if ( ! (is_file($this->_swing_file_path) && file_exists($this->_swing_file_path)) ) 
        {
            $this->prepare_file();
        }

        include_once($this->_swing_file_path); //Read the file and use the $data array right away.
        include_once($this->_special_file_path); //Read the special events

        $title_info = 'swing';

        return view('event_display.home', compact('data','special','title_info'));
    }

    public function blues() //This one reads blues from file directly
    {
        if ( ! (is_file($this->_blues_file_path) && file_exists($this->_blues_file_path)))
        {
            $this->prepare_file();
        }

        include_once($this->_blues_file_path); //Read the file and use the $data array right away.
        include_once($this->_special_file_path); //Read the special events

        $title_info = 'blues';

        return view('event_display.home', compact('data', 'special','title_info'));
    }

    // FEATURE FUNCTIONS ====================================================================================
    // FEATURE FUNCTIONS ====================================================================================
    //Real time data fetching.
    public function fetch_api_data()
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

        $optParams['maxResults'] = 10; //We just fetch ONE special events;
        $optParams['timeMax'] = $this->_current_time->addweeks(5)->format('c'); //Fetch the coming 3 weeks events.    
        //Swing Calendar - Special
        $calendarId = Self::TAIWAN_SWING_CALENDAR_SPECIAL; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $special['events'] = $taiwan_swing_special_info['modelData']['items'];
        $special['calendarId'] = Self::TAIWAN_SWING_CALENDAR_SPECIAL;

        $title_info = 'swing';

        return view('event_display.home', compact('data','special','title_info'));
    }


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
        $blues_info = $calendar->get_events($calendarId, $optParams);
        $data[2]['events']        = $blues_info['modelData']['items'];
        $data[2]['calendarId'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;

        //These 2 below are needed. just to export.
        $blues_data[2]['events']        = $blues_info['modelData']['items'];
        $blues_data[2]['calendarId'] = Self::TAIPEI_BLUES_EVENTS_CALENDAR;

        $optParams['maxResults'] = 10; //We just fetch ONE special events;
        $optParams['timeMax'] = $this->_current_time->addweeks(5)->format('c'); //Fetch the coming 3 weeks events.    
        //Swing Calendar - Special
        $calendarId = Self::TAIWAN_SWING_CALENDAR_SPECIAL; //Swing Calendar.
        $taiwan_swing_special_info = $calendar->get_events($calendarId, $optParams);
        $special['events'] = $taiwan_swing_special_info['modelData']['items'];
        $special['calendarId'] = Self::TAIWAN_SWING_CALENDAR_SPECIAL;

        $this->_check_and_delete_static_files();

        //Make that event_file
        $all_info = array_merge($taiwan_swing_special_info['modelData']['items'], $blues_info['modelData']['items'], $taiwan_swing_regular_info['modelData']['items']);
        $this->_prepare_events_dict_file($all_info);

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
    private function _fetch_rebuild_event($event_type, $eventId)
    {
        if ( ! is_file($this->_event_file_path) && ( ! file_exists($this->_event_file_path)))
        {
            $this->prepare_file(); //if no file found then recreate! 
        }

        include_once($this->_event_file_path);

        $event_data['event_info'] = $data[$eventId];
        $event_data['expire_time'] = $event_data['event_info']['start']['dateTime'];

        switch($event_type)
        {
            case 'Swing':
                $event_data['type'] = 0;
                break;
            case 'Special':
                $event_data['type'] = 1;
                break;
            case 'Blues':
                $event_data['type'] = 2;
                break;
        }

        return $event_data;
    }


    //Here we prepare events file
    private function _prepare_events_dict_file($all_info)
    {
        date_default_timezone_set("Asia/Taipei");
        $gen_time = date("Y-m-d H:i:s");

        $event_with_key = []; //Loop through and change key.

        if ( is_array($all_info) && count($all_info) > 0 )
        {   
            foreach($all_info as $single_event)
            {
                $event_with_key[$single_event['id']] = $single_event;
            }
        }

        file_put_contents($this->_event_file_path, '<!-- FILE GEN AT: ' . $gen_time .  ' --><?php $data = ' . var_export($event_with_key, true) . ';');
        
        return 'Event File written at [' . $gen_time . ']';
    }

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

        if (is_file($this->_event_file_path) && file_exists($this->_event_file_path))
        {
            unlink($this->_event_file_path); 
        }
    }

    private function _fetch_event_by_id($calendarId, $eventId)
    {
        //Not used just save

        //Fetch API part
        $calendarId = $this->_cal[$event_type];
        $calendar = new GoogleCalendar;
        $event_object = $calendar->get_unique_event($calendarId, $eventId);
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
        // $img_url = '<img border="0" src="http://2.bp.blogspot.com/-IU6NUe_3JRA/VlaQZXDDj6I/AAAAAAADOhw/ETH4ovfm8jo/s1600/8795400.gif">';

        $weather_call = "http://opendata.cwb.gov.tw/opendataapi?dataid=" . Self::WEATHER_API_ID . "&authorizationkey=" . $this->_conf_data['Weather_api_key']; 

        // $weather_key = 'O-A0002-001'; //Checking Rain status.
        // $weather_key = 'O-A0003-001'; //局屬氣象站-現在天氣觀測報告
        // $weather_key = 'W-C0033-003'; //毫大雨特報

        // $weather_call = "http://opendata.cwb.gov.tw/opendataapi?dataid=" .$weather_key . "&authorizationkey=" . $this->_conf_data['Weather_api_key']; 


        $weather_info = file_get_contents($weather_call);

        //Parse that fucking XML to array 
        $xml_data = simplexml_load_string($weather_info);        
        $json_info = json_encode($xml_data);
        $weather_array = json_decode($json_info, TRUE);

        echo '<pre>';
        print_r($weather_array);

        echo '</pre>';

        // echo '<pre>';
        // print_r($weather_array['dataset']['location'][0]);
        // echo '</pre>';

        //return $img_url;
    }

    public function log()
    {
        return view('logs');
    }

}