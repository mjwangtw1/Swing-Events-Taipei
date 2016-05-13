@extends('layout.swing')

@section('content')

<?php

    echo 'test here';
    

?>



    <div class="the_event is__detail">
        <div class="row">


            <div class="small-12 columns">
                <div class="event_page the__name">
                    <h4>
                        Simply Swing 免費體驗+練習 Free Lesson + Practice
                    </h4>
                </div>
            </div>


            <div class="small-12 columns">
                <div class="event_page the__detail">


                    <!-- 本次活動的時間 -->
                    <div class="the_calendar row align-center">
                        <div class="small-3 columns">
                            <div class="date_calendar">
                                <!-- 月份 -->
                                <div class="for__month">12 月</div>
                                <!-- 日期 -->
                                <div class="for__day">30</div>
                            </div>
                        </div>
                        <div class="small-5 columns">
                            <div class="for__relateday">
                                <span>還有 999 天</span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="small-12 columns">
                            <div class="for__day_time">
                                <!-- 星期 -->
                                <span>星期日</span>
                                <!-- 視覺分隔點 -->
                                ．
                                <!-- 時刻 -->
                                <span>16:30</span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        
                        <div class="small-12 columns">
                            <!-- 地點 -->
                            <div class="for__placename">
                                <i class="icon is__pin_b o_vt s_normal">&nbsp;</i>
                                <p>
                                    國父紀念館 SYS Memorial Hall
                                </p>
                            </div>

                            <div class="to__googlemap">
                                <a href="javascript:void(0)" class="button small">Google 地圖</a>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="small-12 columns">
                            <div class="for__description">
                                <p>
                                    活動頁面 https://www.facebook.com/events/102046990207239/
                                    【Swing Dance 體驗教學：16:30~】→不須舞蹈基礎，歡迎! 
                                    (根據現場情況時間可能更動，請隨意詢問周圍舞者關於體驗教學詳情)
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="seperator small-12 columns">
                            <hr>
                        </div> 

                        <div class="fb_share small-6 columns">
                            <a href="javascript:void(0)" class="button to__fbshare">
                                <i class="icon s_normal o_hz is__fbshare">&nbsp;</i>
                                分享
                            </a>
                        </div>
                        <div class="fb_forward small-6 columns">
                            <a href="javascript:void(0)" class="button to__messenger">
                                <i class="icon s_normal o_hz is__fbmessenger">&nbsp;</i>
                                轉發
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="small-12 columns">
            <div class="the_event is__recommend">
                <h6>
                    為您推薦
                </h6>

                <div class="event_box row small-collapse">
                    <!-- 信封封面 -->
                    <div class="small-10 columns">
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
                                            <div class="for__day">02</div>
                                        </div>
                                    </div>
                                    <div class="small-7 columns">
                                        <div class="date_clock">
                                            <!-- 相對日期 -->
                                            <span class="for__relateday">兩天後</span>
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
                            </a>
                        </div>
                    </div>

                    <!-- 信封開口 -->
                    <div class="envelop_open small-2 columns">
                        &nbsp;
                    </div>

                </div>
                
                <div class="event_box row small-collapse">
                    <!-- 信封封面 -->
                    <div class="small-10 columns">
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
            <div class="the_menu">
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
