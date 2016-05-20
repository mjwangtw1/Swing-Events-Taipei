<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LiveController extends Controller
{
    //
    public function live()
    {
        $data['provider'] = 'BigApple Party';

        return view('event_display.live', compact('data'));
    }

}
