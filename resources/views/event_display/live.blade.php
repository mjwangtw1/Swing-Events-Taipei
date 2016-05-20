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

 <!--                  <iframe width="400" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=http://maps.google.com.tw/maps?f=q&hl=zh-TW&geocode=&q=中正紀念堂&z=比例大小&output=embed&t=地圖模式></iframe>
 -->
          <!--         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9956.346498099374!2d121.54319099767083!3d25.036257263903703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x3862944b40c0c5b8!2z5YeqKE5hZ2kp6LGa6aqo5ouJ6bq1IOW_oOWtneW6lw!5e0!3m2!1szh-TW!2stw!4v1463473000916" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe> -->
            </div>
        </div>

    </footer>

@stop

@section('footer_js')

    <script src="{{ URL::asset('js/custom/home.js') }}"></script>

@stop
