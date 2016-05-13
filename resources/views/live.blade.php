<?php
use Carbon\Carbon;
$dt = Carbon::now(); //Don't delete this:server site Time formatting.
$event_type = ['Swing', 'Special', 'Blues'];
$event_type_dom = ['is__swing', 'is__special', 'is__blues'];

$weekday['en'] = ['Sun', 'Mon','Tue','Wed','Thu','Fri','Sat'];
$weekday['tw'] = ['周日', '周一','周二','周三','周四','周五','周六'];

?>

@extends('layouts.swing')

@section('content')
    <header class="live_stream">

        <div class="row">
            <div class="small-12 columns text-center">
                <div class="the_logo">
                    <h4 class="logo_text">
                        Swing Events
                    </h4>
                    <div class="logo_taipei for__live">
                        &nbsp;
                    </div>
                    <div>
                        Live!
                    </div>
                </div>
            </div>
                
                
            <div class="the_menu small-12 columns hide-for-medium">
                <div class="row align-center">
            
                    <!-- Cluster for Promo Events -->
                    <div class="small-4 columns">
                        <div class="special_promo">
                            <!-- <a href="javascript:void(0)">
                                <span>
                                    Taipei Lindy Festival 2016
                                </span>
                            </a> -->
                        </div>
                    </div>
            
                    <!-- For Language Switch -->
                    <div class="small-4 columns">
                        <form method="post" action="/locale">
                            <button name="locale" class="button small for__language" type="submit" value="{{ Session::get('locale') === "tw" ? "en" : "tw" }}">
                                English
                            </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
            
                    <!-- For Menu -->
                    <div class="small-4 columns">
                        <!-- <a href="javascript:void(0)">
                            <i class="icon is__hamburger o_hz s_normal">&nbsp;</i>
                            <h6>
                                選單
                            </h6>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>

    </header>

    <div class="content is__live">
        <iframe src="http://www.ustream.tv/embed/15479191?html5ui&volume=0&showtitle=false" style="border: 0 none transparent;"  webkitallowfullscreen allowfullscreen frameborder="no"></iframe>
    </div>


    <footer class="row">

        <div class="small-12 columns text-center">
            <div>
                <span class="copyright">&copy; 2016 Swing Events@Taipei</span>
            </div>
        </div>

    </footer>

@stop

@section('footer_js')

    <script src="{{ URL::asset('js/custom/home.js') }}"></script>

@stop