<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swing Events@Taipei</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/swing.css', TRUE) }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slick.css', TRUE) }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slick-theme.css', TRUE) }}">

  </head>
  <body>
    @yield('content')

    <!-- JS --> 
    <script src="{{ URL::asset('js/public/jquery/dist/jquery.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/public/what-input/what-input.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/public/foundation-sites/dist/foundation.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/public/slick.min.js', TRUE) }}"></script>
    <script src="{{ URL::asset('js/custom/swing.js', TRUE) }}"></script>

    @yield('footer_js')
  </body>
</html>
