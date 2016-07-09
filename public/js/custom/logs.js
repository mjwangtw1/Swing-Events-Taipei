"use strict"

//Doc Ready
$(function() 
{
    console.log('js for log page');

    var code_hour = 0;
    var design_hour = 0;

    var hour_obj = $('li');
    var current_el;

   console.log(hour_obj);

   hour_obj.each(function(elements)
   {
        //code_hour += parseInt($(elements).data('code'));

        // console.log('this hour' + $(elements).data('code'));

        // current_el = $(elements).data('code');

        // if ( 'undefined' != current_el)
        // {
        //     code_hour += parseInt(current_el);
        //     console.log(parseInt(current_el));
        // }



   });

   console.log(code_hour);
});