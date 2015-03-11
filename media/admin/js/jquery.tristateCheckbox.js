/*
 * jQuery tristate checkbox plugin v1.0
 * 
 * Copyright (c) 2012 Pavel Herink
 * Context - http://www.vzak.cz
 * 
 * Dual licensed under the MIT and GPL licenses.
 *
 */
(function($){
	$.fn.tristateCheckbox = function(options) {
		return this.each(function(){
        
        if($(this).parent().hasClass("tristateCheckboxContainer")) return;
    
        var jsFileLocation = $('script[src*="jquery.tristateCheckbox.js"]').attr('src');
        jsFileLocation = jsFileLocation.replace('jquery.tristateCheckbox.js', '');
         
     		var settings = {
       		'default_state': 0, // 0 - itermediate, 1 - checked, 2 - unchecked
       		'checked_img': jsFileLocation+'../img/checked.gif',
       		'checked_value': 1,
       		'intermediate_img': jsFileLocation+'../img/intermediate.gif',
       		'intermediate_value': 'null', // should maintain default html checkbox compatibility (null - no value will be send)
       		'unchecked_img': jsFileLocation+'../img/unchecked.gif',
       		'unchecked_value': 2 // 
       	};
    		jQuery.extend(settings, options);
    		
    		var state_array=new Array();
    		state_array[0]=[settings.intermediate_value,settings.intermediate_img,"nerozhoduje"];
    		state_array[1]=[settings.checked_value,settings.checked_img,"všechny platné"];
    		state_array[2]=[settings.unchecked_value,settings.unchecked_img,"všechny neplatné"];
    		
    		var state_id=settings.default_state;
       	
       	$(this).wrap('<div class="tristateCheckboxContainer" />');
        var container = $(this).parent();
        
        var checkboxImage=$('<img src="'+state_array[state_id][1]+'" title="'+state_array[state_id][2]+'" />');
        var checkboxHidden=$('<input type="hidden" name="'+$(this).attr("name")+'" value="'+state_array[state_id][0]+'" />');
        
        container.append(checkboxImage);
        if(state_array[state_id][0]!="null") container.append(checkboxHidden);
        $(this).remove();
        
        checkboxImage.click(function(){
          state_id = (state_id==2)? 0 : state_id+1;
          checkboxImage.attr("src",state_array[state_id][1])
          checkboxImage.attr("title",state_array[state_id][2])
          if(state_array[state_id][0]=="null"){
            checkboxHidden.remove(); // no value will be submitted
          }else{
            container.append(checkboxHidden);
            checkboxHidden.attr("value",state_array[state_id][0])
          }
      		
          return false;
      	});
  	
    });
  };
})(jQuery);