
    //Hoist functions to the very top
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    //This to Dynamic change Photo Credit by js
    function replace_photo(file_path)
    {
        //Here trying to get the name out.
        var image_source_name = ''; //reset
        var group_url ='';
        var filename = file_path.split('stock/').pop();
        var source_name = filename.split('.png');    
        image_source_name = source_name[0].replace(/\_/g, " ");

        switch(image_source_name)
        {
            case 'YM SWING':
                group_url = 'https://www.facebook.com/YMSWING/?fref=ts';
                break;
            case 'TAIPEI LINDY FESTIVAL 2014':
                group_url = 'http://www.taipeilindyfestival.com/';
                break;
        }

        //Replace image
        // Temp comment for video background
        $('.featured_cover').css('background-image', 'url(' + file_path + ')');

        //Modify Photo Credit.
        $('.photo_source').html(image_source_name);
        $('.photo_source_link').attr('href', group_url);

        //$('.photo_source_link').attr('href', "https://www.facebook.com/nsintaiwan/?fref=ts");
    }

    function update_status(type)
    {
        var target = $('#status');

        target.data('id', type);
    }


    function start_bg_video(player_id)
    {
        //Mount Credits for Video
        //$('.photo_source').html('NaughtySwing x TWSDA');
        $('.photo_source').html('TAIPEI LINDY FESTIVAL 2016');

        $('.photo_source').addClass('video_source').removeClass('photo_source');

        $('.photo_source_link').attr('href', "http://www.taipeilindyfestival.com/");

        //indicate that we are playing 
        //$('#status').data('id','video');
        update_status('video');

        //Launch youtube player
        $('.featured_cover').YTPlayer
        ({
            fitToBackground: true,
            videoId: player_id,
            playerVars: {
                start:0,
                //start:52,
                //end:13,
              modestbranding : 1
            },
            repeat:false,
            version: 3,
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event)
    {
        //0: Done,
        if (0 == event.data) //video playback finished
        {
            switch_back_to_background();
        }
    }

    function switch_back_to_background()
    {
        //Remove Player
        $('.ytplayer-container').hide();

        $('.video_source').addClass('photo_source').removeClass('video_source');

        update_status('photo');

        var bg_file_path = '/assets/stock/TAIPEI_LINDY_FESTIVAL_2014.png';
        replace_photo(bg_file_path);
        
        $('.the_event').show();
        $('.swing_intro').show();
        $('footer').show();
        $('#ict >span').html('Replay');
    }

    function toggle_bg_player(playObject)
    {
        var playerIsMuted = playObject.isMuted();

        if (playerIsMuted)
        {
            playObject.unMute();
            $('.the_event').hide();
            $('.swing_intro').hide();
            $('footer').hide();
        }
        else
        {   
            playObject.mute();
            $('.the_event').show();
            $('.swing_intro').show();
            $('footer').show();
        }
    }

    function bgloadVideoById(videoId)
    {
        var video_id;
           // video_id = 'MOD0pcKfVWY'; //I Charleston Taipei
            video_id = 'zgJitM2-FZM';

        var player = $('.featured_cover').data('ytPlayer').player;
        player.loadVideoById(video_id);

        //player.loadVideoById('MOD0pcKfVWY'); //I Charleston Taipei

        //TLF Promo zgJitM2-FZM
        //player.loadVideoById('MOD0pcKfVWY'); 
        //
        
        //Temp Hack
    }

    //MDFH's animation part
    function trigger_event_animation(mobile_device)
    {
        var featured_image_1_path = '/assets/stock/TAIPEI_LINDY_FESTIVAL_2014.png';
        var featured_image_2_path = '/assets/stock/YM_SWING.png'; 

        //This value sets the opacity seconds for Desktop Version.
        //Mobile version we turned it off (Mobile version does not load video)
        var opacity_secs = (mobile_device) ? '+=0' :  '+=0';

        var feature_title = $('.for__feature_title');

        // Speical Event buttons
        var feat_event_btn = document.querySelector('.menu_c4');   
        
        // Gsap animation
        var special_opacity = new ScrollMagic.Controller();

        // Setup a new gsap timeline 
        // 搭配影片背景，一開始半透明看影片，opacity_secs 秒後，恢復正常
        var tl_spcl_opct = new TimelineLite()
        .to(".is__featured", .5, { opacity: 1 }, opacity_secs)
        .to(".swing_intro", .5, { opacity: 1 }, '-=0.2');

        // ScrollMagic參數設定 (scene_home_scroll)
        // 當 .featured_cover 碰到畫面最上方時啟動動畫: tl_spcl_opct 
        var scene_home_scroll = new ScrollMagic.Scene
        ({
            triggerElement: ".featured_cover",
            triggerHook: 0,
            reverse: true
        })
        
        // 呼叫 Timeline
        .setTween(tl_spcl_opct)
        // Debug Mode
        // .addIndicators({name: "tl_spcl_opct (duration: 0)"})
        // 啟動 Scrollmagic
        .addTo(special_opacity);

        // 首頁捲動後的動畫 Controller
        var home_scroll = new ScrollMagic.Controller();

        // 首頁 Header Bar 顯示/隱藏動畫
        //     -- 在桌面版顯示的動畫
        if (document.documentElement.clientWidth > 640) 
        {
            var tl_header_bg = new TimelineLite()
            .to(".the_logo_main", .25, { opacity: 0, marginBottom: '-1rem', ease: Power3.easeIn }, '-=0.5')
            .to(".header_bg", .36, { opacity: 1 }, '-=0.25')
            // Special Event Opacity Switch
            .to(".is__featured", .2, { opacity: 1 }, '-=0.2')
            .to(".swing_intro", .2, { opacity: 1 }, '-=0.2')
            .to(".menu_c4", .36, { marginTop: 0 }, '-=0.25')
            // Switch Speical Event buttons to right
            .add
            (
                function()
                {
                    feat_event_btn.classList.toggle('medium-offset-4');
                    feat_event_btn.classList.toggle('medium-offset-9');
                }
            )
            .to(".the_logo_side", .25, { opacity: 1 });
            // .to(".featured_cover", 2, { y: -75 }, '-=2');
        }
        //  -- 在手機版顯示的動畫
        else 
        {
            var tl_header_bg = new TimelineLite()
            .to(".the_logo_main", .5, { opacity: 0, marginBottom: '-6rem', ease: Power3.easeIn })
            .to(".the_menu", .5, { marginTop: '1rem' }, '-=0.5')
            .to(".header_bg", .5, { opacity: 1 })
            .to(".the_logo_side", .25, { opacity: 1 });
        }

        // ScrollMagic參數設定 (home_scroll)
        // 當 .is__featured 碰觸到畫面的 60% 時啟動 Header 動畫: tl_header_bg
        var scene_home_scroll = new ScrollMagic.Scene
        ({
            triggerElement: ".is__featured",
            triggerHook: 0.6,
            reverse: true
        })
        
        // 呼叫 Timeline
        .setTween(tl_header_bg)
        // Debug Mode
        // .addIndicators({name: "1 (duration: 0)"})
        // 啟動 Scrollmagic
        .addTo(home_scroll);


        // Featured Events: Switch from for 5 seconds
        var feaS_1 = document.getElementsByClassName("is__featured_1");
        var feaS_2 = document.getElementsByClassName("is__featured_2");
        // var Ovrly_1 = feaS_1.getElementsByClassName("for__switch_layer");
        // var Ovrly_2 = feaS_2.getElementsByClassName("for__switch_layer");

        // 兩個 Special Events 的前後切換動畫
        // 自動開始，沒有搭配 ScrollMagic
        // 桌面版：左上與右下切換
        if (document.documentElement.clientWidth > 640) 
        {
        var tl_switch = new TimelineLite
        (
            // 結束後重頭再來一次
            { onComplete:
                function()
                {
                    this.restart()
                }
            }
        )
            .to(feaS_1, .5, {marginTop: 0, marginLeft: 0}, "+=7")
            .to(feaS_2, .5, {marginTop: '-2.5rem', marginLeft: '-1.5rem'}, '-=0.25')
            .to(feaS_1, 1, {zIndex: 50}, '-=1')
            .to(feaS_2, 1, {zIndex: 75}, '-=1')
            // Switch Background using callbacks
            .add
            (
                function()
                {
                    replace_photo(featured_image_2_path);
                }
            )
            // 
            .to(".is__featured_2 .for__switch_layer", 1, {opacity: 0}, '-=0.5')
            .to(".is__featured_1 .for__switch_layer", 1, {opacity: 1}, '-=1')
            .to(feaS_2, .5, {marginTop: 0, marginLeft: 0}, "+=7")
            .to(feaS_1, .5, {marginTop: '-2.5rem', marginLeft: '-1.5rem'}, "-=0.25")
            .to(feaS_1, 1, {zIndex: 75}, '-=1')
            .to(feaS_2, 1, {zIndex: 50}, '-=1')
             // Switch Background using callbacks
            .add
            (
                function()
                {
                    replace_photo(featured_image_1_path);
                }
            )
            .to(".is__featured_2 .for__switch_layer", 1, {opacity: 1}, "-=0.5")
            .to(".is__featured_1 .for__switch_layer", 1, {opacity: 0}, "-=1")
         
                
        // 呼叫 Timeline
        .setTween(tl_switch)
        }
        // 手機版：垂直切換
        else 
        {
            var tl_switch = new TimelineLite
            (
                { onComplete:
                    function()
                    {
                        this.restart()
                    }
                }
            )
            .to(feaS_1, .5, {marginTop: '3rem'}, "+=8")
            .to(feaS_2, .5, {marginTop: 0}, '-=0.25')
            .to(feaS_1, 1, {zIndex: 50}, '-=1')
            .to(feaS_2, 1, {zIndex: 75}, '-=1')
            // Switch Background using callbacks
            .add
            (
                function()
                {
                    replace_photo(featured_image_2_path);
                }
            )
            // 
            .to(".is__featured_2 .for__switch_layer", 1, {opacity: 0}, '-=0.5')
            .to(".is__featured_1 .for__switch_layer", 1, {opacity: 1}, '-=1')
            .to(feaS_2, .5, {marginTop: '3rem'}, "+=5")
            .to(feaS_1, .5, {marginTop: 0}, "-=0.25")
            .to(feaS_1, 1, {zIndex: 75}, '-=1')
            .to(feaS_2, 1, {zIndex: 50}, '-=1')
             // Switch Background using callbacks
            .add
            (
                function()
                {
                    replace_photo(featured_image_1_path);
                }
            )
            .to(".is__featured_2 .for__switch_layer", 1, {opacity: 1}, "-=0.5")
            .to(".is__featured_1 .for__switch_layer", 1, {opacity: 0}, "-=1")
         
                
        // 呼叫 Timeline
        .setTween(tl_switch)
        }
    }


//Doc Ready
$(function() 
{
    //Launch bg teaser
    var ict_teaser_id = 'zTPCiyeEl3E'; //This is teaser
        ict_teaser_id = 'MOD0pcKfVWY'; //This is Main ICT //We use this one now.
        ict_teaser_id = 'zgJitM2-FZM'; // TLF 2014 video

    var mobile_device = isMobile.any();

    if (mobile_device)
    {
        //Mobile mode
        switch_back_to_background();
        $('#ict').hide(); //Turn off Video button
    }
    else
    {
        //0821-update: we turn off Video Autoplay first.
        //start_bg_video(ict_teaser_id);
        switch_back_to_background();
        $('#ict >span').html('PLAY');        

        //Behavior when clicked 'Music'
        $('#ict').on('click', function(){

            var now_status = $('#status').data('id');

            if('video' == now_status)
            {
                //enlarge video and unmute
                var playerObject = $('.featured_cover').data('ytPlayer').player;
                toggle_bg_player(playerObject);
            }
            else
            {
                //Restart the player
                start_bg_video(ict_teaser_id);
                $('#ict >span').html('Music');
            }
        });

    }
    
    trigger_event_animation(mobile_device);

});//end of Doc ready