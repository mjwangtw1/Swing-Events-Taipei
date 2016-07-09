"use strict";

//Doc Ready
$(function() 
{
    console.log('js for log page 11');

    var code_hour = 0;
    var design_hour = 0;

    var hour_obj = $('li');
    var current_el;

   hour_obj.each(function(id, elements)
   {
        if (undefined != $(elements).data('code'))
        {
            code_hour += parseInt($(elements).data('code'));
        }
  
        if (undefined != $(elements).data('design'))
        {
            design_hour += parseInt($(elements).data('design'));
        }
   });

   $('#code_hour').html(' ' + code_hour + ' Hours');
   $('#design_hour').html(' ' + design_hour + ' Hours');


});