
<script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/custom/grid.js') }}"></script>

<h1>This is grid test</h1>
<h4>最後一格故意選用錯誤的img_path(會讀不到圖)</h4>
<head>
    <style>
        * {
            box-sizing: border-box;
        }
        .row::after {
            content: "";
            clear: both;
            display: block;
        }
        [class*="col-"] {
            float: left;
            padding: 15px;
        }
        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}
        html {
            font-family: "Lucida Sans", sans-serif;
        }
        .header {
            background-color: #9933cc;
            color: #ffffff;
            padding: 15px;
        }
        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .menu li {
            padding: 8px;
            margin-bottom: 7px;
            background-color :#33b5e5;
            color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        .menu li:hover {
            background-color: #0099cc;
        }
        img
        {
            width: 50px;
            height: 50px;
        }
        
        .load
        {
            text-align:center;
            line-height:50px;
            background-color: lightblue;
        }

</style>
</head>
<body>
    <div class="row">
        <div class="col-1 image load" >
            Click
        </div>

        <div class="col-1 image" >
            <img class="img" id="img0" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img1" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img2" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img3" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img4" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img5" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img6" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img7" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img8" src="">
        </div>
        <div class="col-1 image" >
            <img class="img" id="img9" src="">
        </div>
       

    </div>
</body>
