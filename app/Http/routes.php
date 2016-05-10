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


//Entrance Page
Route::get('/', 'DataController@home'); //預設直接進來 就看本日活動

//OFFICIAL
Route::get('/home', 'DataController@home'); // List Events within this week
Route::get('/blues', 'DataController@blues'); // List Events within this week
Route::get('/now', 'DataController@now');   // List whatever happened Today.
Route::get('/event/{calendarId}/{eventId}/{typeId}', 'DataController@event'); //List Specific Event with Detailed Info

Route::get('/log', 'DataController@log'); //Check to see logs


//for MDFH-- Mockup places
Route::get('/sample/event_detail', 'DataController@event_detail');
Route::get('/sample/home', 'DataController@sample');
Route::get('/sample', 'DataController@sample');

//Calendar Feature
Route::get('/calendar', 'CalendarController@index');


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


