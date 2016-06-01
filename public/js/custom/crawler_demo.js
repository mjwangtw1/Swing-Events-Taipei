//Doc Ready;
$(function() 
{
    console.log('Crawler demo');

    // console.log(price_data);

    title = '價格比較表';

    var data_for_graph = [];

    var counter = 10;
    //here prepare_data
    $.each( price_data, function( key, value ) {
      // alert( key + ": " + value );
      // console.log(value.name);
      // console.log(key);
      // data_for_graph[key][x] = counter;
      // data_for_graph[key][y] = value.price;

      data_for_graph[key] = { x:counter, y: value.price, indexLabel: value.name }; //Define all data here.

      counter += 10;
    });

    // console.log(data_for_graph);

    window.onload = function () {

    //Better to construct options first and then pass it as a parameter
        var options = {
            title: {
                text: title
            },
                    animationEnabled: true,
            data: [
            {
                type: "column", //change it to line, area, bar, pie, etc
                // dataPoints: [
                //     { x: 10, y: 10 },
                //     { x: 20, y: 11 },
                //     { x: 30, y: 14 },
                //     { x: 40, y: 16 },
                //     { x: 50, y: 19 },
                //     { x: 60, y: 15 },
                //     { x: 70, y: 12 },
                //     { x: 80, y: 10 }
                // ]
                dataPoints: data_for_graph

            }
            ]
        };

        $("#chartContainer").CanvasJSChart(options);

    }

})