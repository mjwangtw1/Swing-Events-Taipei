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

//OFFICIAL
Route::get('/blues', 'DataController@blues'); //Sync file and create local files.
Route::get('/home', 'DataController@home'); // List Events within this week
Route::get('/now', 'DataController@now');   // List whatever happened Today.
Route::get('/event/{calendarId}/{eventId}/{typeId}', 'DataController@event'); //List Specific Event with Detailed Info

//Try adding
Route::get('/try_add', 'DataController@quickadd'); //Sync file and create local files.

//Here for backend create content
Route::get('/event/new', 'EventController@new'); //For making new events.
Route::get('/event_list', 'EventController@index'); //Post-login Class Controller.

Route::post('/event/insert', 'EventController@insert'); //For ACTUAL inserting a new data.

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
//Testing
Route::get('/test', 'DataController@test');

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


