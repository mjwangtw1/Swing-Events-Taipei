<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swing Events Taipei</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/swing.css', TRUE) }}">

    @yield('header_css')

  </head>
  <body>
    @yield('content')

    <!-- JS --> 
    <script src="{{ URL::asset('js/public/jquery/dist/jquery.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/public/what-input/what-input.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/public/foundation-sites/dist/foundation.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/custom/swing.js', TRUE) }}"></script>

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
