//Doc Ready
$(function() 
{
    var featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12512641_10208470701592694_323433579423670011_n.jpg?oh=d1b8cb0176d62aea71c7efbf205db444&oe=57E240B6';

    var raining_image_path = '/public/assets/stock/event_in_rain.jpg';

    var featured_image_1_path = '/assets/stock/TAIPEI_LINDY_FESTIVAL_2014.png';
    var featured_image_2_path = '/assets/stock/YM_SWING.png';

    var type = $('.the__name').data('type');


    //Weather_stuff - Daily Weather / will shift to hourly forecast soon
    var weather_api = 'http://api.openweathermap.org/data/2.5/weather?q=Taipei,%20TW&units=metric&APPID=c7d5f3891c1d17185cb20355e2a6177e';


    function get_weather_info()
    {
        $('#weather_rain').hide();

        $.ajax({
          url: weather_api,
          dataType: "json",
 
          success: function(result)
          {
            var temp_min = result.main.temp_min;
            var temp_max = result.main.temp_max;

            var avg_tmp = (temp_min + temp_max) / 2;

            //Update the weather
            $('.the__degree').html(temp_min.toFixed(1)); 

            //if it rains
            var weather_type = result.weather[0].main;

            // weather_type = 'Rain';

            var check_if_rain = weather_type.match(/[Rr]ain/g);

            if (check_if_rain)
            {
                $('#weather_temp').hide();
                $('#weather_rain').show();

                $('#weather_icon').show();
                $('.current_degree').addClass('for__attention').removeClass('text_center');
            }
          }          
        });
    }



    // switch(type)
    // {
    //     //Special Event
    //     case 1:
    //         featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xtp1/v/t1.0-9/s851x315/13096080_1709318172689797_2323366522317056287_n.jpg?oh=35c7494bf39d9a5af2214561e43d6f2a&oe=57B39033';
    //       break;
    //     //Blues
    //     case 2:
    //         featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/13012637_1689938167939726_3648725892285269119_n.jpg?oh=ab67ced89ff600d9449e5ad4474ca41a&oe=57E1D6EA';
    //         break;
    //     //Swing(Overall)
    //     case 0:
    //     default:
    //         // Remains the same. // use default;
            
    //         break;
    // }

    //Currently just point to YM Swing image
    featured_image_path = featured_image_2_path;

    $('.event_cover').css('background-image', 'url(' + featured_image_path + ')');

    get_weather_info();

});//end of Doc ready