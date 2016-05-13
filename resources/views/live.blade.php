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

    <div class="content is__live">
        <iframe src="http://www.ustream.tv/embed/15479191?html5ui&volume=0&showtitle=false" style="border: 0 none transparent;"  webkitallowfullscreen allowfullscreen frameborder="no"></iframe>
    </div>

    <footer class="row">

        <div class="live_stream">
            <div class="row">
                <div class="small-12 columns text-center">
                    <a href="/"><div class="the_logo">
                            <h4 class="logo_text">
                                Swing Events
                            </h4>
                            <div class="logo_taipei for__live">
                                &nbsp;
                            </div>
                        </div>
                    </a>
                    <div>
                        Live!
                    </div>
                </div>
            </div>
        </div>

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
