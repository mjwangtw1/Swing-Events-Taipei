
<script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/custom/crawler_demo.js') }}"></script>
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script> -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.min.js"></script>
<body>
<h1>Crawler Demo</h1>

<script>
var price_data = <?php echo json_encode($data); ?>;

</script>
<div class="data">
<?php
    //var_dump($data);

    if( ! empty($data))
    {
        foreach($data as $key=> $single_source)
        {
            ?>
            <div class="site" id="site<?php echo $key?>"data-site="<?php echo $single_source['name']?>" data-price="<?php echo $single_source['price']?>">
                <span class="name"><?php echo $single_source['name']?></span>
                <span class="price"><?php echo $single_source['price']?></span>
            </div>

            <?php
        }
    }
?>  
</div>
<div class="chart">


</div>
<div id="chartContainer" style="height: 300px; width: 100%;">
</div>


</body>
