<?php
use Carbon\Carbon;
$dt = Carbon::now(); //Don't delete this:server site Time formatting.
$event_type = ['Swing', 'Special', 'Blues'];
$event_type_dom = ['is__swing', 'is__special', 'is__blues'];

$weekday['en'] = ['Sun', 'Mon','Tue','Wed','Thu','Fri','Sat'];
$weekday['tw'] = ['周日', '周一','周二','周三','周四','周五','周六'];

$logo_text = ('swing' == $title_info) ? 'Swing Events' : 'Blues Events';
$logo_class = ('swing' == $title_info) ? '' : 'is__blues';

$type = Route::getCurrentRoute()->getPath(); //'blues' or 'home'

//Hijack for blues event
if ('blues' == $type)
{
    //a stupid reverse;
    $rev_data[0] = $data[2];
    $rev_data[2] = $data[0];
    unset($data);
    $data = $rev_data;

    $event_type = ['Blues', 'Special', 'Swing'];
    $event_type_dom = ['is__blues', 'is__special', 'is__swing'];
}

?>

@extends('layouts.swing')

@section('content')
    <header class="page__home">

        <div class="row">

            <div class="the_logo_main small-12 columns">
                <h1 class="logo_text">
                    <?php echo $logo_text; ?>
                </h1>
                <div class="logo_taipei <?php echo $logo_class?>">
                    &nbsp;
                </div>
            </div>
            
            <div class="the_menu small-12 columns">
                <div class="row small-collapse">

                    <div class="menu_c1 medium-9 columns hide-for-small show-for-medium">
                        <div class="the_logo_side small-12 columns">
                            <h1 class="logo_text">
                                <?php echo $logo_text; ?>
                            </h1>
                            <div class="logo_taipei <?php echo $logo_class?>">
                                &nbsp;
                            </div>
                        </div>
                    </div>


                    <!-- Cluster for Credits -->
                    <div class="menu_c2 small-6 medium-2 columns hide-for-small show-for-medium">
                        <div class="photo_credit row"> 
                            <div class="small-5 columns">
                                <h6>credit</h6>
                            </div>
                            <div class="small-7 columns">
                                <a href="javascript:void(0)">
                                    <span class="photo_source"></span>
                                </a>
                            </div>
                        </div>
                    </div>



                    <!-- For Language Switch -->
                    <div class="menu_c3 small-3 medium-1 columns">
                        <form method="post" action="/locale">
                            <button name="locale" class="button small for__language" type="submit" value="{{ Session::get('locale') === "tw" ? "en" : "tw" }}">
                                {{ Session::get('locale') === "tw" ? " English" : "中文" }}
                            </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>


                    <!-- Cluster for Promo Events -->
                    <div class="menu_c4 small-9 medium-3 columns medium-offset-4">
                        <a href="http://www.taipeilindyfestival.com/" class="special_promo" target="_blank">
                            <span>
                                {{ trans('default.tlf2016') }}
                            </span>
                        </a>
                        <a href="javascript:void(0)" class="special_promo" id="ict">
                            <span>
                        <!--         {{ trans('default.ichartp') }} -->
                                Music 
                            </span>
                        </a>
                    </div>


                </div>
            </div>

        </div>

    </header>

    <div class="header_bg">
        &nbsp;
    </div>


    <div class="featured_cover">
        &nbsp;
    </div>


    <div class="content in__home row">
        
        <!-- Featured -->
        <?php

        $featured_flag = FALSE;

        $event_counts = count($special['events']);

        switch($event_counts)
        {         
            case 0:  //No special events, then 1 blues 1 swing

                //First One use Swing events;
                $special_event[0] = $data[0]['events'][0]; 
                $special_event[0]['type'] = 0;
                $special_event[0]['link'] = '/event/' . $event_type[$special_event[0]['type']] .'/' . $special_event[0]['id'];
                

                //2nd One use Blues
                $special_event[2] = $data[2]['events'][0]; 
                $special_event[2]['type'] = 2;

                $special_event[2]['link'] = '/event/'.$event_type[$special_event[2]['type']] .'/' . $special_event[2]['id'];
                

                break;

            case 1: //1st Special 2nd Swing
                $special_event[0] = $special['events'][0];
                $special_event[0]['type'] = 1;

                $special_event[0]['link'] = '/event/' .$event_type[$special_event[0]['type']] .'/' . $special['events'][0]['id'];
                
                $random_guess = rand(1,2);
                if(1 == $random_guess)
                {
                    //Show Swing
                    $special_event[2] = $data[0]['events'][0]; 
                    $special_event[2]['type'] = 0;
                    $special_event[2]['link'] = '/event/' . $event_type[$special_event[0]['type']] .'/' . $special_event[0]['id'];
                }
                else
                {   
                    //Show BLUES
                    $special_event[2] = $data[2]['events'][0]; 
                    $special_event[2]['type'] = 2;

                    $special_event[2]['link'] = '/event/'.$event_type[$special_event[2]['type']] .'/' . $special_event[2]['id'];
                    
                }

                break;

            //More than 2 special events    
            case 2:   
            default:
                $special_event[0] = $special['events'][0];
                $special_event[0]['link'] = '/event/Special/' . $special['events'][0]['id'];
                $special_event[0]['type'] = 1;

                $special_event[2] = $special['events'][1];
                $special_event[2]['link'] = '/event/Special/' . $special['events'][1]['id'];
                $special_event[2]['type'] = 1;

                break;
        }

            $special_event[0]['class'] = 'is__featured_1';
            $special_event[2]['class'] = 'is__featured_2';

        ?>

        <div class="the_event is__featured small-12 medium-5 medium-offset-1 columns">
            
            <div class="row align-center">
                <div class="small-12 columns">

                    @foreach ($special_event as $id=> $single_special_event)
                    <div class="description_box {{$single_special_event['class']}} row align-center">
                        <!-- 活動標題 -->
                        <h3 class="event_header for__feature_title small-12 columns">
                        
                            {{ $single_special_event['summary'] }}
                        
                            <span class="label {{ $event_type_dom[$single_special_event['type']] }} for__home">{{ $event_type[$single_special_event['type']] }}</span>
                            
                            <!-- @if( $featured_flag)
                    
                                <span class="label to__detail">
                                   {{ trans('default.featured') }}
                                    <i class="icon o_vt s_small is__chevy_right"></i>
                                </span>
                            
                            @endif -->
                        </h3>

                        <div class="small-3 medium-2 columns">
                            <div class="date_calendar">
                                <!-- 月份 -->
                                <div class="for__month">
                                  {{ $dt->parse($single_special_event['start']['dateTime'])->format('M') }}
                                </div>
                                <!-- 日期 -->
                                <div class="for__day">
                                    {{ $dt->parse($single_special_event['start']['dateTime'])->format('d') }} 
                                </div>
                            </div>
                        </div>

                        <div class="small-7 medium-6 columns">
                            <div class="date_clock">
                               
                                <?php
                        
                                    $weekday_counter = $dt->parse($single_special_event["start"]["dateTime"])->format("w");
                                    
                                    $lang_type = (Session::get('locale') === "tw") ? 'tw' : 'en';
                                    
                                    echo $weekday[$lang_type][$weekday_counter];
                                ?>
                                <!-- 視覺分隔點(全型的點)-->
                                ．
                                <!-- 相對日期 -->
                                <span class="for__relateday">
                                
                                        <?php
                                            if($dt->parse($single_special_event['start']['dateTime'])->isToday())
                                            {
                                                echo trans('default.today'); 
                                            }
                                            else
                                            {
                                                //Calculate the Difference.
                                                $count = $dt->diffInDays($dt->parse($single_special_event['start']['dateTime'])); //Start from 0 so add 1
                                                if (0 == $count)
                                                {
                                                    echo trans('default.tomorrow');
                                                }
                                                else
                                                {
                                                    $count = $count + 1; //add 1 more day 
                                                    
                                                    echo trans('default.days_till', ['count' => $count]);
                                                }
                                            }
                                        ?>
                                </span>
                                <!-- 視覺分隔點 -->
                                ．
                                <!-- 當天時間 -->
                                <span class="for__oclock">
                                    {{ $dt->parse($single_special_event['start']['dateTime'])->format('H:i') }} 
                                </span>
                            </div>
                            <!-- 地點 -->
                            <div class="for__placename">
                                <i class="icon is__pin o_vt s_small">&nbsp;</i>
                                <span>
                              {{ isset($single_special_event['location']) ? $single_special_event['location'] : '' }}
                                </span>
                            </div>
                        </div>

                        <!-- Switch Layer -->
                        <a href="{{ $single_special_event['link'] }}" class="for__switch_layer">
                            <div>&nbsp;</div>
                        </a>
                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        <div class="small-6 columns hide-for-small show-for-medium">
            <div class="row align-center small-collapse">
                <div class="swing_intro small-10 columns">
                    <h5 class="hello_title">
                        <i class="hello_title_tp">&nbsp;</i>
                    </h5>
                    <section class="hello_text">
                        <p>
                            Swing dance (搖擺舞)是一種復古舞蹈，源於 1930 年代的美國。它充滿了樂趣，而且保證跳完後你一定開心得闔不攏嘴！
                        </p>
                        <p>
                            如果你喜歡爵士音樂或復古文化，更或者只是想度過一段美好時光，都可以﻿免費參加各個團體的練習時間﻿。不用擔心你之前是否跳過，我相信一定會有舞者帶你入門的。
                        </p>
                        <p>
                            我們喜歡這個舞蹈，相信你們也會喜歡。來跟我們一起跳舞吧！
                        </p>
                    </section>
                </div>
            </div>
        </div>
    
    </div>

    <!-- Thisweek -->
    <div class="row small-collapse align-center">

        @if ( ! empty($data))
            
        <div class="the_event is__thisweek small-12 medium-5 columns">
            <h6>
                {{ trans('default.event_this_week') }}
            </h6>
             
              @foreach($data as $type => $event)

                @foreach($event['events'] as $single_event)

            <div class="event_box row small-collapse align-center">
                <!-- 信封封面 -->
                <div class="envelop_body small-10 medium-8 columns">
                    <div class="row small-collapse align-right">
                        <a href="/event/{{ $event_type[$type] }}/{{ $single_event['id']}}" class="cover_box small-10 columns">
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
                                                    $count = $dt->diffInDays($dt->parse($single_event['start']['dateTime'])); //Start from 0 so add 1
                                                    if (0 == $count)
                                                    {
                                                        echo trans('default.tomorrow');
                                                    }
                                                    else
                                                    {
                                                        $count = $count + 1; //add 1 more day 

                                                        echo trans('default.days_till', ['count' => $count]);
                                                    }
                                                    
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


    <footer class="row">

        <div class="the_logo small-12 columns">
            <a href="/">
                <h4 class="logo_text">
                    <?php echo $logo_text?>
                </h4>
                <div class="logo_taipei for__footer <?php echo $logo_class?>">
                    &nbsp;
                </div>
            </a>
        </div>

        <div class="seperator small-12 columns">
            <hr>
        </div>

        <div class="small-12 columns hide-for-medium">
            <div class="photo_credit row small-collapse align-center text-center">
                           
                <div class="small-2 columns">
                    <h6>credit</h6>
                </div>
                <div class="small-4 columns">
                    <a href="javascript:void(0)">
                        <span class="photo_source"></span>
                    </a>
                </div>

            </div>
        </div>


        <div class="seperator small-12 columns hide-for-medium">
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

    <div id="tv"></div>


@stop

@section('footer_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js"></script>
    <!-- ScrollMagic Indicator -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/easing/EasePack.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TimelineLite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenLite.min.js"></script>

    
    <!-- Remodal -->
    <!-- <script src="{{ URL::asset('js/public/remodal.min.js') }}"></script> -->

    <!-- Video BG -->
    <script src="{{ URL::asset('js/public/jquery.youtubebackground.js') }}"></script>

    <script src="{{ URL::asset('js/custom/home.js') }}"></script>

@stop

