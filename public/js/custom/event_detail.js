//Doc Ready
$(function() 
{
    var featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/v/t1.0-9/12512641_10208470701592694_323433579423670011_n.jpg?oh=d1b8cb0176d62aea71c7efbf205db444&oe=57E240B6';

    var type = $('.the__name').data('type');

    switch(type)
    {
        //Special Event
        case 1:
            featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xtp1/v/t1.0-9/s851x315/13096080_1709318172689797_2323366522317056287_n.jpg?oh=35c7494bf39d9a5af2214561e43d6f2a&oe=57B39033';
          break;
        //Blues
        case 2:
            featured_image_path = 'https://scontent-tpe1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/13012637_1689938167939726_3648725892285269119_n.jpg?oh=ab67ced89ff600d9449e5ad4474ca41a&oe=57E1D6EA';
            break;
        //Swing(Overall)
        case 0:
        default:
            // Remains the same. // use default;
            
            break;
    }

    $('.event_featured_cover').css('background-image', 'url(' + featured_image_path + ')');

});//end of Doc ready