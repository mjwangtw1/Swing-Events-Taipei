<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Config;

class LocaleController extends Controller 
{
 
    public function chooser (Request $request) 
    {
        $lang= $request->input("locale");

        if (array_key_exists($lang, Config::get('languages'))) 
        {
            Session::set('locale', $lang);
        }

        return Redirect::back();
    }
}