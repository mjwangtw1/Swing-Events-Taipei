<?php
use Carbon\Carbon;
$dt = Carbon::now(); //Don't delete this:server site Time formatting.
$event_type = ['SWING', 'SPECIAL', 'BLUES'];
$event_type_dom = ['is__swing', 'is__special', 'is__blues'];
$weekday['en'] = ['Sun', 'Mon','Tue','Wed','Thu','Fri','Sat'];
$weekday['tw'] = ['星期日', '星期一','星期二','星期三','星期四','星期五','星期六'];

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

    </header>

        <!-- Thisweek -->
        <div class="small-12 columns">
        
            @if( ! empty($data))

            <div class="the_event is__thisweek">
                <h6>
                    {{ trans('default.today') }}
                </h6>

                @foreach($data as $type => $event)

                    @foreach($event['events'] as $single_event)

                   <div class="event_box row small-collapse align-center">
                    <!-- 信封封面 -->
                    <div class="small-10 medium-8 columns">
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
                                                   {{ $dt->parse($single_event['start']['dateTime'])->format('M') }}  
                                            </div>
                                            <!-- 日期 -->
                                            <div class="for__day">
                                                {{ $dt->parse($single_event['start']['dateTime'])->format('d') }} 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">

                                                 <?php
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
                                            ?>

                                            </span>
                                            <!-- 視覺分隔點 -->
                                            ．
                                            <!-- 當天時間 -->
                                            <span class="for__oclock">
                                                {{ $dt->parse($single_event['start']['dateTime'])->format('H:i') }} 
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
                    <div class="envelop_open small-2 columns">
                        &nbsp;
                    </div>
                </div>
                    
                    @endforeach

                @endforeach

            </div>

            @else

                <h6>  {{ trans('default.no_events')}} </h6>
    
            @endif

        </div>
    
    </div>

    <footer class="row">

        <div class="the_logo small-12 columns">
            <h4 class="logo_text">
                Swing Events
            </h4>
        </div>

        <div class="small-12 columns">
            <div class="the_menu">
                <div>
                    <a href="{{ url('/calendar') }}">{{ trans('default.calendar') }}</a>
                </div>
                <div>
                    <a href="{{ url('/group') }}">{{ trans('default.group') }}</a>
                </div>
                <div>
                    <a href="{{ url('/course') }}">{{ trans('default.course') }}</a>
                </div>
                <div>
                  <a href="{{ url('/event') }}">{{ trans('default.event') }}</a>
                </div>
                <div>
                 <a href="{{ url('/tlf2016') }}">{{ trans('default.tlf2016') }}</a>
                </div>
            </div>
        </div>

    </footer>

@stop
