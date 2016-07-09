
    //Hoist functions to the very top

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

    function trigger_bg_teaser(player_id)
    {
        //Mount Credits for Video
        $('.photo_source').html('NaughtySwing x TWSDA');
        $('.photo_source').addClass('video_source').removeClass('photo_source');

        $('.photo_source_link').attr('href', "https://www.facebook.com/nsintaiwan/?fref=ts");

        //Launch youtube player
        $('.featured_cover').YTPlayer
        ({
            fitToBackground: true,
            videoId: player_id,
            playerVars: {
                start:0,
                //start:52,
                end:15,
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

        var bg_file_path = '/assets/stock/TAIPEI_LINDY_FESTIVAL_2014.png'
        replace_photo(bg_file_path);
        //$('.featured_cover').css('background-image', 'url(' + bg_file_path + ')');
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
        var player = $('.featured_cover').data('ytPlayer').player;
        player.loadVideoById('MOD0pcKfVWY');
    }

//Doc Ready
$(function() 
{
    //var featured_image_1_path = '/assets/stock/featured_cover_1.png';
    //var featured_image_2_path = '/assets/stock/featured_cover_2.png';
    var featured_image_1_path = '/assets/stock/TAIPEI_LINDY_FESTIVAL_2014.png';
    var featured_image_2_path = '/assets/stock/YM_SWING.png';
    //var featured_image_path = 'http://2.bp.blogspot.com/-IU6NUe_3JRA/VlaQZXDDj6I/AAAAAAADOhw/ETH4ovfm8jo/s1600/8795400.gif'; //Bird GIF
    //var featured_image_path = '/assets/stock/featured_cover.jpg'; //STOCK photo

    var out_door_swing ='https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12036520_1043850722321767_815228896261137827_n.jpg?oh=9305c825779894b481afda78a5d6388a&oe=57D06B7E';

    //Turn off first.
    //featured_image_path = out_door_swing;

    var feature_title = $('.for__feature_title');

    // Speical Event buttons
    var feat_event_btn = document.querySelector('.menu_c4');

    // console.log(feature_title);
    // var feature_event_image = new Object;

    // //Defualt IMAGE
    // feature_event_image.default_swing_image = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xtp1/v/t1.0-9/s851x315/13096080_1709318172689797_2323366522317056287_n.jpg?oh=35c7494bf39d9a5af2214561e43d6f2a&oe=57B39033';
    // //By Days

    // //Monday
    // feature_event_image.mon_swing_taoyuan = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/19517_850992051642524_6798979834289661046_n.jpg?oh=1b064a04050650afe54b3504658e1463&oe=57B39CF3';
    // feature_event_image.mon_ssp_blues = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12994515_1012897602135747_4096033759731417486_n.jpg?oh=81f1546ea3941190c170d9535b0c2d9d&oe=57E39A1E';
    // feature_event_image.mon_nnu_swing = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/1931131_911262298993977_9101991130787989809_n.jpg?oh=5e68c1802ec99ff4c408f7945db3891e&oe=579DB8A8';
    // feature_event_image.mon_bap_swing = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12743843_1192847957393801_9214864731779289367_n.jpg?oh=33eae024aea7df5e0ffc7fddc44c5a08&oe=57B8BCC5';

    // //Tuesday
    // feature_event_image.tues_sa_outdoor = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/10537034_1638819473073001_7870107413760163284_n.png?oh=6bd64db0732fd0902c03e5a26af2d35d&oe=57AF85AD';
    
    // //Wed
    // feature_event_image.wed_triangle_retro = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/984080_1263576720338782_2062506142461575927_n.jpg?oh=e6948694faebba0ab17f89a040e91b55&oe=57ACC141';
    // feature_event_image.wed_fu11_blues = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/13012637_1689938167939726_3648725892285269119_n.jpg?oh=ab67ced89ff600d9449e5ad4474ca41a&oe=57E1D6EA';
    // feature_event_image.wed_ym_aviee = 'https://scontent.xx.fbcdn.net/v/t1.0-9/s720x720/12417810_887145741399569_5398871670755591361_n.jpg?oh=d4fd6bacc87df31f1e64eb824f0c1e16&oe=57A1500F';

    // //Thurs
    // feature_event_image.thurs_kat_thur_practice = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/1511075_461053044100547_317648773289563181_n.jpg?oh=7a8e486c89f1154d02c3565596a30dae&oe=57E3549D';

    // //Friday
    // feature_event_image.fri_ba_tgif_indoor = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xlf1/v/t1.0-9/13119090_1266380073376716_1445367240092490241_n.jpg?oh=5042105dcb47eb5c97a21157d7f325cd&oe=57AB951B';
    // feature_event_image.fri_st_tgif_outdoor = 'https://scontent-tpe1-1.xx.fbcdn.net/l/t31.0-8/12998151_1257777910906976_8038705991653956881_o.jpg';
    // //Sat
    // feature_event_image.sat_ym_swing_sat = 'https://scontent-tpe1-1.xx.fbcdn.net/t31.0-8/13040828_1161383737235131_238219362377237534_o.jpg';
    
    // //Sun
    // feature_event_image.sun_ss_sun_outdoor = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12512641_10208470701592694_323433579423670011_n.jpg?oh=d1b8cb0176d62aea71c7efbf205db444&oe=57E240B6';

    //Previous Dynamic change photo
    //replace_photo(featured_image_1_path);

    //Launch bg teaser
    var ict_teaser_id = 'zTPCiyeEl3E';

    ict_teaser_id = 'MOD0pcKfVWY';

    trigger_bg_teaser(ict_teaser_id);

    $('#ict').on('click', function(){

        var playerObject = $('.featured_cover').data('ytPlayer').player;
        toggle_bg_player(playerObject);

    });


    // Gsap animation
    // 0705: 特別動畫預告
    var special_opacity = new ScrollMagic.Controller();

    var tl_spcl_opct = new TimelineLite()
    .to(".is__featured", .5, { opacity: 1 }, '+=16')
    .to(".swing_intro", .5, { opacity: 1 }, '-=0.2');

    // ScrollMagic參數設定 (scene1)
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

    // Timeline宣告
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
    else 
    {
        var tl_header_bg = new TimelineLite()
        .to(".the_logo_main", .5, { opacity: 0, marginBottom: '-6rem', ease: Power3.easeIn })
        .to(".the_menu", .5, { marginTop: '1rem' }, '-=0.5')
        .to(".header_bg", .5, { opacity: 1 })
        .to(".the_logo_side", .25, { opacity: 1 });
    }

    // ScrollMagic參數設定 (home_scroll)
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

    // Timeline宣告

    if (document.documentElement.clientWidth > 640) 
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

});//end of Doc ready