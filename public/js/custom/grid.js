//Doc Ready;
$(function() 
{
    var load_image = 'http://www.jqueryscript.net/images/jQuery-Ajax-Loading-Overlay-with-Loading-Text-Spinner-Plugin.jpg';
    var fail_image = 'http://acornishgirl.com/wp-content/uploads/2014/02/Failed-580x390.jpg';

    //Sample Data
    var items = [
          { title: 'Cat 1', image: 'http://placekitten.com/311/313' },
          { title: 'Cat 2', image: 'http://placekitten.com/302/302' },
          { title: 'Cat 3', image: 'http://placekitten.com/303/303' },
          { title: 'Cat 4', image: 'http://placekitten.com/304/304' },
          { title: 'Cat 5', image: 'http://placekitten.com/305/305' },
          { title: 'Cat 6', image: 'http://placekitten.com/306/306' },
          { title: 'Cat 7', image: 'http://placekitten.com/307/307' },
          { title: 'Cat 8', image: 'http://placekitten.com/308/308' },
          { title: 'Cat 9', image: 'http://placekitten.com/310/310' },
          { title: 'Cat 9', image: 'http://placekitte.com/310/310' }
    ];

    console.log('===This is grid demo=== 2244');


    //Pre-load //Fill with Load image.
    $('.img').attr("src", load_image);

    $('.load').on('click',function()
    {
        //Load the defined image
        $.each(items, function( key, value ) 
        {
            var target = '#img' + key;

            $(target).attr("src", value.image)
            .error(function() {
                //this happen if load fails - Load the fail image
                $(target).attr("src", fail_image);
            });
        });

    })


});