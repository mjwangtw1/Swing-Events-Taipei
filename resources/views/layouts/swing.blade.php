<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Swing Events Taipei, providing Current swing/blues dance event info in Taipei" />
    <meta property="og:title" content="Swing Events Taipei"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="swing.mouchunwang.com"/>
    <meta property="og:image" content="https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/13626548_1133817489974617_2983607581269085493_n.png?oh=9a7e69c4a2daa7ef7099e09ba02e74e8&oe=58115716"/>
    <meta property="og:description" content="Swing Events Taipei, providing Current swing/blues dance event info in Taipei"/>
    <meta property="og:site_name" content="Swing Events Taipei"/>

    <title>Swing Events Taipei</title>

    <!-- favicon -->
    <link rel="icon" href="/assets/icon/favicon.ico" type="image/x-icon">
    
    <!-- CSS: Remodal -->
    <!-- <link rel="stylesheet" href="{{ URL::asset('css/remodal.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ URL::asset('css/remodal-custom-theme.css') }}"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/swing.css') }}">

    @yield('header_css')

  </head>
  <body>
    @yield('content')
  
    <!-- JS CDN-->
    <script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/what-input/2.0.1/what-input.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.1.2/foundation.min.js"></script>

    <!--JS -->
    <script src="{{ URL::asset('js/custom/swing.js') }}"></script>

    <!-- GA Section-->
    <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-77278467-1', 'auto');
          ga('send', 'pageview');
    </script>
    <!-- GA Section-->

    @yield('footer_js')

  </body>
</html>
