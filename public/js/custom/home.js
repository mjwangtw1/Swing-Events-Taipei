//Doc Ready
$(function() 
{
    var featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xtp1/v/t1.0-9/s851x315/13096080_1709318172689797_2323366522317056287_n.jpg?oh=35c7494bf39d9a5af2214561e43d6f2a&oe=57B39033';
    //var featured_image_path = 'http://2.bp.blogspot.com/-IU6NUe_3JRA/VlaQZXDDj6I/AAAAAAADOhw/ETH4ovfm8jo/s1600/8795400.gif'; //Bird GIF
    //var featured_image_path = '/assets/stock/featured_cover.jpg'; //STOCK photo

    var feature_title = $('.for__feature_title');

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

    //$('.featured_cover').css('background-image', 'url(' + featured_image_path + ')');

    // 0520: New gsap animation
    // 變數宣告
    var controller = new ScrollMagic.Controller();

    // Timeline宣告
    var tl_header_bg = new TimelineLite()
        .to(".page__home", .5, {scaleX: .75, scaleY: .75, y: -15})
        .to(".header_bg", .5, {opacity: 1}, "-=0.4")


    // ScrollMagic參數設定 (scene1)
    var scene1 = new ScrollMagic.Scene
    ({
        triggerElement: ".is__featured",
        triggerHook: 0.6,
        // duration: 100,
        reverse: true
    })
    
    // 呼叫 Timeline
    .setTween(tl_header_bg)
    // Debug Mode
    // .addIndicators({name: "1 (duration: 0)"})
    // 啟動 Scrollmagic
    .addTo(controller);

});//end of Doc ready