<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//Multi-language feature.
Route::post('/locale', array(
     'before' => 'csrf',
     'as' => 'language-chooser',
     'uses' => 'LocaleController@chooser'
));

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/redirect', function()
{
    //This page toss user from Heroku error page to swing.mouchunwang.com
    return view('errors.503');
});

Route::get('/sitemap', function()
{
    return view('sitemap');
});

Route::get('/map', function()
{
    return view('map');
});


//This one for SSL-thing.
Route::get('/.well-known/acme-challenge/{id}', function($id)
{
    include(base_path() . "/_conf/.well-known/acme-challenge/$id");
});


//Entrance Page
Route::get('/', 'DataController@home'); //預設直接進來 就看本日活動

//Here for backend create content
Route::get('/new_event', 'EventController@new_event'); //For making new events.
Route::get('/event_list', 'EventController@index'); //Post-login Class Controller.

Route::post('/event/insert', 'EventController@insert'); //For ACTUAL inserting a new data.

Route::get('/crawl_demo/{data_string}', 'DemoController@try_data'); //This is the sample .
Route::get('/crawl_demo', 'DemoController@try_data'); //This is the sample .

//OFFICIAL
Route::get('/blues', 'DataController@blues'); //Sync file and create local files.
Route::get('/home', 'DataController@home'); // List Events within this week
Route::get('/realtime', 'DataController@fetch_api_data'); // List Events within this week
Route::get('/now', 'DataController@now');   // List whatever happened Today.
Route::get('/event/{event_type}/{eventId}', 'DataController@event'); //List Specific Event with Detailed Info
Route::get('/event_n/{event_type}/{eventId}', 'DataController@event_n'); //List Specific Event with Detailed Info With FORCE Refresh


//Try adding
//Route::get('/try_add', 'DataController@insert_to_calendar'); //Sync file and create local files.
Route::get('/try_del/{calendarType}/{eventId}', 'EventController@delete_event_from_calendar'); //Sync file and create local files. //Becareful with this one! 


//Backend - for coding purpose
Route::get('/sync_all', 'DataController@prepare_file'); //Sync all 3.
Route::get('/read', 'DataController@check_data'); //Sync file and create local files.


//Previous: Directly load API 
Route::get('/home2', 'DataController@home'); // List Events within this week
Route::get('/blues2', 'DataController@blues'); // List Events within this week



Route::get('/live', 'LiveController@live'); //Check to see logs
Route::get('/log', 'DataController@log'); //Check to see logs


//for MDFH-- Mockup places
Route::get('/sample/event_detail', 'DataController@event_detail');
Route::get('/sample/home', 'DataController@sample');
Route::get('/sample', 'DataController@sample');

//Calendar Feature
Route::get('/calendar', 'CalendarController@index');

//Create A new Event
Route::post('/event/insert', 'EventController@insert'); //Insert New courses.


//Course - Still working.
Route::get('/course/new', 'CourseController@new_course'); //Go to new course insert page.
//Course-Insert Content
Route::post('/course/insert', 'CourseController@insert'); //Insert New courses.
Route::get('/course', 'CourseController@index'); //Post-login Class Controller.

//Dynamic Data Page
Route::get('/data', 'DataController@index');

//Route::get('/now', 'DataController@calendar');
// Route::get('/event', 'DataController@event');

Route::get('/test_sample', function()
{
    return view('test_sample');
});

Route::get('/whazzup', function()
{
    return 'Whazzup bro';
});


//Testing - For Codility Tests.
Route::get('/test1', 'TestController@iteration_q');
Route::get('/test2', 'TestController@array_q');
Route::get('/test3', 'TestController@array_q2');
Route::get('/test4', 'TestController@frog_jump');
Route::get('/test5', 'TestController@cal_permutation');

Route::get('/test6', 'TestController@tape_equilibrium');
Route::get('/test7', 'TestController@perm_missing_elem');
Route::get('/test8', 'TestController@frog_river_one');
Route::get('/test9', 'TestController@missing_integer');
Route::get('/test10', 'TestController@max_counter');

Route::get('/test11', 'TestController@passing_cars');
Route::get('/test12', 'TestController@cal_permutation');
Route::get('/test13', 'TestController@cal_permutation');
Route::get('/test14', 'TestController@cal_permutation');

Route::get('/check1', 'TestController@check_1');
Route::get('/check2', 'TestController@check_2');
Route::get('/check3', 'TestController@check_3');
Route::get('/check4', 'TestController@check_4');
Route::get('/check5', 'TestController@check_5');


//X1 - 9 times 9
Route::get('/square/{n}', 'AlgoController@square');
Route::get('/square', 'AlgoController@square');

//X2 - Fizzbuzz
Route::get('/fizz/{n}', 'AlgoController@fizzbuzz');
Route::get('/fizz', 'AlgoController@fizzbuzz');

//X3 - GCD
Route::get('/gcd/{a}/{b}', 'AlgoController@gcd');
Route::get('/gcd', 'AlgoController@gcd');

//X4 - LCM
Route::get('/lcm/{a}/{b}', 'AlgoController@lcm');
Route::get('/lcm', 'AlgoController@lcm');

//X5 - isPrime
Route::get('/isprime/{n}', 'AlgoController@is_prime');
Route::get('/isprime', 'AlgoController@is_prime');

//X6 - Print Square
Route::get('/print_sq/{n}', 'AlgoController@print_square');
Route::get('/print_sq', 'AlgoController@print_square');


Route::get('/grid', 'TestController@grid');


//Just for Fun
Route::get('/sam', 'DataController@sam');
//Static pages ====

//ABOUT page 
Route::get('/about', 'PageController@about');

//TEACHER info page.
Route::get('/teacher', 'PageController@teacher');


//Post-Login Page

Route::auth();

Route::get('/homepage', 'HomeController@index');


