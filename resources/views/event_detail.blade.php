<?php
use Carbon\Carbon;
$dt = Carbon::now(); //Don't delete this:server site Time formatting.\
$event_type = ['Swing', 'Special', 'Blues'];
$event_type_dom = ['is__swing', 'is__special', 'is__blues'];

$weekday['en'] = ['Sun', 'Mon','Tue','Wed','Thu','Fri','Sat'];
$weekday['tw'] = ['周日', '周一','周二','周三','周四','周五','周六'];

?>

@extends('layouts.swing')

@section('content')
        <div class="the_event is__detail">

        <div class="row">
            <div class="event_page small-12 columns">
                <div class="the__name" data-type="{{$event['type']}}">
                    <h4>
                        {{ $event->summary }}

                        <span class="label {{$event_type_dom[$event['type']]}}">
                            {{$event_type[$event['type']]}}
                        </span>
                    </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="event_page small-12 medium-6 large-4 columns">
                <div class="the__detail">

                    <!-- 本次活動的時間 -->
                    <div class="the_calendar row align-center">
                        <div class="small-3 columns">
                            <div class="date_calendar">
                                <!-- 月份 -->
                                <div class="for__month">
                                    {{ 
                                    
                                    isset($event['modelData']['start']['dateTime']) ? $dt->parse($event['modelData']['start']['dateTime'])->format('M') : '' }}  
                                </div>
                                <!-- 日期 -->
                                <div class="for__day">
                                    {{ isset($event['modelData']['start']['dateTime']) ? $dt->parse($event['modelData']['start']['dateTime'])->format('d') : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="small-5 columns">
                            <div class="for__day_time">

                                <!-- 星期 -->
                                <span>

                                 <?php

                                    if(isset($event['modelData']['start']['dateTime']))
                                    {
                                        $weekday_counter = $dt->parse($event['modelData']['start']['dateTime'])->format("w");
                                        $lang_type = (Session::get('locale') === "tw") ? 'tw' : 'en';
                                        echo $weekday[$lang_type][$weekday_counter];
                                    }
                                ?>

                                </span>
                                <!-- 視覺分隔點 -->
                                ．
                                <!-- 時刻 -->
                                <span>

                                    {{ isset($event['modelData']['start']['dateTime']) ? $dt->parse($event['modelData']['start']['dateTime'])->format('H:i') : '' }} 

                                <!-- 16:30 -->

                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="the_calendar row">
                        <div class="small-12 columns">
                            <div class="for__relateday">
                                <span>

                                <!-- 還有 999 天 -->
                                    
                                <?php
                                if (isset($event['modelData']['start']['dateTime']))
                                {
                                     if($dt->parse($event['modelData']['start']['dateTime'])->isToday())
                                    {
                                        echo trans('default.today'); 
                                    }
                                    else
                                    {
                                        //Calculate the Difference.
                                        $count = $dt->diffInDays($dt->parse($event['modelData']['start']['dateTime'])) + 1; //Start from 0 so add 1
                                        echo trans('default.days_till', ['count' => $count]);
                                    }

                                }
                               

                                ?>

                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="small-12 columns">
                            <!-- 地點 -->
                            <div class="for__placename">
                                <i class="icon is__pin_b o_vt s_normal">&nbsp;</i>
                                <p>
                                   <!--  國父紀念館 SYS Memorial Hall -->
                                    {{ isset($event->location) ? $event->location : '' }}
                                </p>
                            </div>

                            <div class="to__external">
                                <a href="https://maps.google.com/maps?hl=zh-TW&amp;q={{ isset($event->location) ? $event->location : '' }}"  class="button small for__eventurl" target="_blank">
                                    {{ trans('default.google_map') }}
                                </a> 
                            
                                <?php
                                    //Dynamic Gen a Link button if there is one! 
                                    if ( ! is_null($event->description))
                                    {
                                        $patt = "/https*:\/\/[a-zA-Z0-9\.\/_]+/";
                                        preg_match($patt, $event->description, $output_array);

                                        if (( ! is_null($output_array[0])) && ( ! empty($output_array[0])))
                                        {   
                                            //Then we parsed a URL link: put it here.   
                                            $link_button = '<a href="' . $output_array[0] . '" class="button small for__navigate" target="_blank">';
                                            $link_button .= trans('default.event_link');
                                            $link_button .= '</a>';

                                            echo $link_button;


                                            //Displaying the Link
                                            $link_show  = '<p class="show_url"><a href="' . $output_array[0] . '" target="_blank">' . $output_array[0] . '</a></p>';
                                         
                                            echo $link_show;

                                        }
                                    }   
                                ?>

                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <div class="event_page small-12 medium-6 large-4 columns">
                <div class="for__description">
                    <p>
                        
                        {{ is_null($event->description) ? '' : $event->description }}

                        <!-- 活動頁面 https://www.facebook.com/events/102046990207239/
                        【Swing Dance 體驗教學：16:30~】→不須舞蹈基礎，歡迎! 
                        (根據現場情況時間可能更動，請隨意詢問周圍舞者關於體驗教學詳情) -->
                    </p>
                </div>
            </div>

            <div class="event_page small-12 large-4 columns">
                <div class="seperator row columns hide-for-large">
                    <hr>
                </div> 

                <div class="row align-center">
                    <div class="event_featured_cover">
                        &nbsp;

                    @if(isset($event->location))

 <!--                    <iframe
                      width="100%"
                      height="250px"
                      frameborder="0" style="border:0"
                      src="https://www.google.com/maps/embed/v1/place?key={{$api_key}}
                        &q={{$event->location}}" allowfullscreen>
                    </iframe> -->

                    @endif

                    </div>
                    <!-- <div class="fb_share small-6 medium-4 columns">
                        <a href="javascript:void(0)" class="button to__fbshare">
                            <i class="icon s_normal o_hz is__fbshare">&nbsp;</i>
                            <span>分享</span>
                        </a>
                    </div> -->
                    <!-- <div class="fb_forward small-6 medium-4 columns">
                        <a href="javascript:void(0)" class="button to__messenger">
                            <i class="icon s_normal o_hz is__fbmessenger">&nbsp;</i>
                            <span>轉發</span>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="the_event is__recommend">
                <h6>
                    {{ trans('default.recommend_for_you')}}
                </h6>

                <div class="row">
    
                    @if( ! empty($data))
                        @foreach($data as $type=> $event)
                            @foreach($event['events'] as $single_event)

                    <div class="small-12 medium-6 large-4 columns">
                        <div class="event_box row small-collapse">
                            <!-- 信封封面 -->
                            <div class="envelop_body small-10 columns">
                                <div class="row small-collapse align-right">
                                    <a href="/event/{{ $event['calendarId'] }}/{{ $single_event['id']}}/{{$type}}" class="cover_box small-10 columns">
                                        <h5>
                                             {{ $single_event['summary'] }}
                                        </h5>
                                        <div class="description_box row small-collapse align-center">
                                            <div class="small-3 columns">
                                                <div class="date_calendar">
                                                    <!-- 月份 -->
                                                    <div class="for__month">{{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('M') : '' }}  </div>
                                                    <!-- 日期 -->
                                                    <div class="for__day">{{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('d') : ''}} </div>
                                                </div>
                                            </div>
                                            <div class="small-7 columns">
                                                <div class="date_clock">
                                                    <?php
                                                        if(isset($single_event["start"]["dateTime"]))
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
                                                    if(isset($single_event['start']['dateTime']))
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
                                                    <span class="for__oclock">{{ isset($single_event['start']['dateTime']) ? $dt->parse($single_event['start']['dateTime'])->format('H:i') : '' }} </span>
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
                    </div>
                        
                            @endforeach
                        @endforeach
                    @else
                        
                        <h6>  {{ trans('default.no_events')}} </h6>
                    
                    @endif

                </div>



            </div>
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
                <span class="copyright">&copy; 2016 Swing Events@Taipei</span>
            </div>
        </div>

    </footer>

@stop

@section('footer_js')

    <script src="{{ URL::asset('js/custom/event_detail.js') }}"></script>

@stop

