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
    <header class="row">

        <div class="the_logo small-12 columns">
            <h1 class="logo_text">
                Swing Events
            </h1>
            <div class="logo_taipei">
                &nbsp;
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
                            {{ Session::get('locale') === "tw" ? " English" : "中文" }}
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

    </header>

    <div class="content row">
        
        <!-- Featured -->
        <?php

        $featured_flag = FALSE;

        if ( ! empty($special['events'])) //Nothing inside Special
        {
            $featured_flag = TRUE; //display the flag only when SPECIAL EVENTS
            //Special Event
            $special_event = $special['events'][0];
            $special_link  = '/event/' . $special['calendarId'] . '/' . $special_event['id'] . '/1';
            $special_type = 1;
        }
        else
        {
            //Or we use the first one we got.
            $special_event = $data[0]['events'][0]; //Fetch Swing event the First one.
            $special_link  = '/event/' . $data[0]['calendarId'] . '/' . $special_event['id'] . '/0';
            $special_type = 0; 
        }

        ?>

        <div class="the_event is__featured small-12 medium-6 columns">
            
            <a href="{{ $special_link }}" class="featured_cover row align-right" >
                <!-- 活動詳情按鈕(指示用，連結在上層) -->
                <!-- <div class="small-6 columns"> -->
                <div class="feature_tags">
 <!--                    <span class="label is__special">Special</span> -->
                    <span class="label {{ $event_type_dom[$special_type] }}">{{ $event_type[$special_type] }}</span>
    
                    @if( $featured_flag)

                        <span class="label to__detail">
                           {{ trans('default.featured') }}
                            <i class="icon o_vt s_small is__chevy_right"></i>
                        </span>
                    
                    @endif

                </div>
            </a>
            <div class="description_box row small-collapse align-center">
                <!-- 活動標題 -->
                <h3 class="event_header for__feature_title small-12 columns">
                     {{ $special_event['summary'] }}
                </h3>
                <div class="small-3 medium-2 columns">
                    <div class="date_calendar">
                        <!-- 月份 -->
                        <div class="for__month">
                          {{ $dt->parse($special_event['start']['dateTime'])->format('M') }}
                        </div>
                        <!-- 日期 -->
                        <div class="for__day">
                            {{ $dt->parse($special_event['start']['dateTime'])->format('d') }} 
                        </div>
                    </div>
                </div>
                <div class="small-7 medium-4 columns">
                    <div class="date_clock">
                       
                        <?php

                            $weekday_counter = $dt->parse($special_event["start"]["dateTime"])->format("w");
                            
                            $lang_type = (Session::get('locale') === "tw") ? 'tw' : 'en';
                            
                            echo $weekday[$lang_type][$weekday_counter];
                        ?>
                        <!-- 視覺分隔點(全型的點)-->
                        ．
                        <!-- 相對日期 -->
                        <span class="for__relateday">
                        
                                <?php
                                    if($dt->parse($special_event['start']['dateTime'])->isToday())
                                    {
                                        echo trans('default.today'); 
                                    }
                                    else
                                    {
                                        //Calculate the Difference.
                                        $count = $dt->diffInDays($dt->parse($special_event['start']['dateTime'])) + 1; //Start from 0 so add 1
                                        echo trans('default.days_till', ['count' => $count]);
                                    }
                                ?>
                        </span>
                        <!-- 視覺分隔點 -->
                        ．
                        <!-- 當天時間 -->
                        <span class="for__oclock">
                            {{ $dt->parse($special_event['start']['dateTime'])->format('H:i') }} 
                        </span>
                    </div>
                    <!-- 地點 -->
                    <div class="for__placename">
                        <i class="icon is__pin o_vt s_small">&nbsp;</i>
                        <span>
                      {{ isset($special_event['location']) ? $special_event['location'] : '' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="swing_intro row hide-for-small show-for-medium">
                <div class="small-12 columns">
                    <h4>
                        哈囉！台北
                    </h4>
                    <hr>
                    <p>
                        Swing dance (搖擺舞)是一種復古舞蹈，源於 1930 年代的美國。它充滿了樂趣，而且保證跳完後你一定開心得闔不攏嘴！
                    </p>
                    <p>
                        如果你喜歡爵士音樂或復古文化，更或者只是想度過一段美好時光，都可以﻿免費參加各個團體的練習時間﻿。不用擔心你之前是否跳過，我相信一定會有舞者帶你入門的。
                    </p>
                    <p>
                        我們喜歡這個舞蹈，相信你們也會喜歡。來跟我們一起跳舞吧！
                    </p>
                </div>
            </div>
        </div>

        <!-- Thisweek -->
        <div class="small-12 medium-6 columns">

            @if ( ! empty($data))
                
            <div class="the_event is__thisweek">
                <h6>
                    {{ trans('default.event_this_week') }}
                </h6>
                
                  @foreach($data as $type => $event)

                    @foreach($event['events'] as $single_event)

                <div class="event_box row small-collapse align-center">
                    <!-- 信封封面 -->
                    <div class="envelop_body small-10 medium-8 columns">
                        <div class="row small-collapse align-right">
                            <a href="/event/{{ $event['calendarId'] }}/{{ $single_event['id']}}/{{$type}}" class="cover_box small-10 columns">
                                <h5>
                                    {{ $single_event['summary'] }}
                                </h5>
                                <div class="description_box row small-collapse align-center">
                                    <div class="small-3 columns">
                                        <div class="date_calendar">
                                            <!-- 月份 -->
                                            <div class="for__month">
                                                   {{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('M') : '' }}  
                                            </div>
                                            <!-- 日期 -->
                                            <div class="for__day">
                                                {{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('d') : '' }} 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <?php

                                                if (isset($single_event['start']['dateTime']))
                                                {
                                                    $weekday_counter = $dt->parse($single_event["start"]["dateTime"])->format("w");
                                                
                                                    $lang_type = (Session::get('locale') === "tw") ? 'tw' : 'en';
                                                    
                                                    echo $weekday[$lang_type][$weekday_counter];
                                                }
                                            ?>
                                            <!-- 視覺分隔點(全型的點)-->
                                            ．
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">

                                                 <?php

                                                if (isset($single_event['start']['dateTime']))
                                                {
                                                    if($dt->parse($single_event['start']['dateTime'])->isToday())
                                                    {
                                                        echo trans('default.today'); 
                                                    }
                                                    else
                                                    {
                                                        //Calculate the Difference.
                                                        $count = $dt->diffInDays($dt->parse($single_event['start']['dateTime'])) + 1; //Start from 0 so add 1
                                                        echo trans('default.days_till', ['count' => $count]);
                                                    }
                                                 }
                                                ?>

                                            </span>
                                            <!-- 視覺分隔點 -->
                                            ．
                                            <!-- 當天時間 -->
                                            <span class="for__oclock">
                                                {{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('H:i') : '' }} 
                                            </span>
                                        </div>
                                        <!-- 地點 -->
                                        <div class="for__placename">
                                            <i class="icon is__pin_b o_vt s_small">&nbsp;</i>
                                            <span>{{ isset($single_event['location']) ? $single_event['location'] : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="the_category small-12 columns">
                                        <span class="label {{ $event_type_dom[$type] }}">{{ $event_type[$type] }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- 信封開口 -->
                    <!-- 21:25 在這裡加上 is__special 之類的標籤 -->
                    <div class="envelop_open {{ $event_type_dom[$type] }} small-2 columns">
                        &nbsp;
                    </div>
                </div>
                
                    @endforeach

                @endforeach

            </div>
            
            @else
                <!-- NO class TEXT -->
            @endif
        
        </div>
    
    </div>


    <footer class="row">

        <div class="the_logo small-12 columns">
            <a href="/">
                <h4 class="logo_text">
                    Swing Events
                </h4>
                <div class="logo_taipei for__footer">
                    &nbsp;
                </div>
            </a>
        </div>

        <div class="seperator small-12 columns">
            <hr>
        </div>

        <div class="small-12 columns text-center">
            <div>
                <a href="http://goo.gl/forms/AlYg1Oqp3q" class="button to__report" role="button" target="_blank">
                    {{ trans('default.report_event') }}
                </a>
            </div>
            <div>
                <span class="copyright">&copy; 2016 Swing Events Taipei</span>
            </div>
        </div>

    </footer>

@stop

@section('footer_js')

    <script src="{{ URL::asset('js/custom/home.js') }}"></script>

@stop

