@extends('sample.layout')

@section('content')
    <header class="row">


        <div class="the_logo small-12 columns">
            <h1 class="logo_text">
                Swing Events
            </h1>
        </div>


        <div class="the_menu small-12 columns hide-for-medium">
            <div class="row align-center">
                <div class="small-4 columns">
                    <button class="button small for__language">English</button>
                </div>
                
                <div class="small-4 columns">
                    <div class="special_promo">
                        <!-- <a href="javascript:void(0)">
                            <span>
                                Taipei Lindy Festival 2016
                            </span>
                        </a> -->
                    </div>
                </div>
                <div class="small-4 columns">
                    <a href="javascript:void(0)">
                        <i class="icon is__hamburger o_hz s_normal">&nbsp;</i>
                        <h6>選單</h6>
                    </a>
                </div>
            </div>
        </div>


    </header>




    <div class="content row">
        <!-- Featured -->
        <div class="the_event is__featured small-12 medium-6 columns">
            <a href="event.html" class="cover_box row align-right">
                <!-- 活動詳情按鈕(指示用，連結在上層) -->
                <!-- <div class="small-6 columns"> -->
                <div class="feature_tags">
                    <span class="label is__special">Special</span>
                    <span class="label to__detail">
                        活動詳情
                        <i class="icon o_vt s_small is__chevy_right"></i>
                    </span>
                </div>
            </a>
            <div class="description_box row small-collapse align-center">
                <!-- 活動標題 -->
                <h3 class="event_header small-12 columns">
                    Simply Swing 免費體驗+練習 Free Lesson + Practice
                </h3>
                <div class="small-3 medium-2 columns">
                    <div class="date_calendar">
                        <!-- 月份 -->
                        <div class="for__month">
                            12 月
                        </div>
                        <!-- 日期 -->
                        <div class="for__day">30</div>
                            30
                        </div>
                    </div>
                </div>
                <div class="small-7 medium-4 columns">
                    <div class="date_clock">
                        <!-- 相對日期 -->
                        <span class="for__relateday">
                            50 天後
                        </span>
                        <!-- 視覺分隔點 -->
                        ．
                        <!-- 當天時間 -->
                        <span class="for__oclock">
                            19:00
                        </span>
                    </div>
                    <!-- 地點 -->
                    <div class="for__placename">
                        <i class="icon is__pin o_vt s_small">&nbsp;</i>
                        <span>
                            國父紀念館 SYS Memorial Hall
                        </span>
                    </div>
                </div>
            </div>

            <div class="swing_intro row hide-for-small show-for-medium">
                <h4>
                    哈囉！台北
                </h4>
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




        <!-- Thisweek -->
        <div class="small-12 medium-6 columns">

            <div class="the_event is__thisweek">
                <h6>
                    本週課程
                </h6>


                <div class="event_box row small-collapse align-center">
                    <!-- 信封封面 -->
                    <div class="small-10 medium-8 columns">
                        <div class="row small-collapse align-right">
                            <a href="javascript:void(0)" class="cover_box small-10 columns">
                                <h5>
                                    Big Apple 搖擺舞室內 social 
                                </h5>
                                <div class="description_box row small-collapse align-center">
                                    <div class="small-3 columns">
                                        <div class="date_calendar">
                                            <!-- 月份 -->
                                            <div class="for__month">5 月</div>
                                            <!-- 日期 -->
                                            <div class="for__day">01</div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">明天</span>
                                            <!-- 視覺分隔點 -->
                                            ．
                                            <!-- 當天時間 -->
                                            <span class="for__oclock">19:00</span>
                                        </div>
                                        <!-- 地點 -->
                                        <div class="for__placename">
                                            <i class="icon is__pin_b o_vt s_small">&nbsp;</i>
                                            <span>國父紀念館 SYS Memorial Hall</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="the_category small-12 columns">
                                        <span class="label is__special">Special</span>
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


                <div class="event_box row small-collapse align-center">
                    <!-- 信封封面 -->
                    <div class="small-10 medium-8 columns">
                        <div class="row small-collapse align-right">
                            <a href="javascript:void(0)" class="cover_box small-10 columns">
                                <h5>
                                    Big Apple 搖擺舞室內 social 
                                </h5>
                                <div class="description_box row small-collapse align-center">
                                    <div class="small-3 columns">
                                        <div class="date_calendar">
                                            <!-- 月份 -->
                                            <div class="for__month">5 月</div>
                                            <!-- 日期 -->
                                            <div class="for__day">01</div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">明天</span>
                                            <!-- 視覺分隔點 -->
                                            ．
                                            <!-- 當天時間 -->
                                            <span class="for__oclock">19:00</span>
                                        </div>
                                        <!-- 地點 -->
                                        <div class="for__placename">
                                            <i class="icon is__pin_b o_vt s_small">&nbsp;</i>
                                            <span>國父紀念館 SYS Memorial Hall</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="the_category small-12 columns">
                                        <span class="label is__blue">Blue</span>
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


                <div class="event_box row small-collapse align-center">
                    <!-- 信封封面 -->
                    <div class="small-10 medium-8 columns">
                        <div class="row small-collapse align-right">
                            <a href="javascript:void(0)" class="cover_box small-10 columns">
                                <h5>
                                    Big Apple 搖擺舞室內 social 
                                </h5>
                                <div class="description_box row small-collapse align-center">
                                    <div class="small-3 columns">
                                        <div class="date_calendar">
                                            <!-- 月份 -->
                                            <div class="for__month">5 月</div>
                                            <!-- 日期 -->
                                            <div class="for__day">03</div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">三天後</span>
                                            <!-- 視覺分隔點 -->
                                            ．
                                            <!-- 當天時間 -->
                                            <span class="for__oclock">19:00</span>
                                        </div>
                                        <!-- 地點 -->
                                        <div class="for__placename">
                                            <i class="icon is__pin_b o_vt s_small">&nbsp;</i>
                                            <span>國父紀念館 SYS Memorial Hall</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="the_category small-12 columns">
                                        <span class="label is__swing">Swing</span>
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

                
            </div>
        </div>
    


    </div>




    <footer class="row">

        <div class="the_logo small-12 columns">
            <h4 class="logo_text">
                Swing Events
            </h4>
        </div>

        <div class="small-12 columns">
            <div class="footer_menu">
                <div>
                    <a href="javascript:void(0)">
                        Calendar
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)">
                        Teachers
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)">
                        Groups
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)">
                        Class &amp; Workshops
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)">
                        Events
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)">
                        Taipei Lindy Festival 2016
                    </a>
                </div>
            </div>
        </div>

    </footer>

@stop
