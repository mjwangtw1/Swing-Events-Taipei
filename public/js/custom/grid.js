//Doc Ready;
$(function() 
{
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
          { title: 'Cat 9', image: 'http://placekitten.com/310/310' }
    ];

    console.log('===This is grid demo=== 2244');

    //jQuery Foreach to loop through
    $.each( items, function( key, value ) 
    {
        console.log( key + ": " + value.image );

        var img_dom = '<img src="' + value.image  + '">';

        $('.main').append(img_dom);

    });



});