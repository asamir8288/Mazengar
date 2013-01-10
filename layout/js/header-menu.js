	  //Script For the Header Drop Down Menu
	  
	  $(document).ready(function(){
	  $(".menu-dropdown-wrapper").hide();
   
                      $('li.more-menu').mouseover(function() {

                        $(this).find(".menu-dropdown-wrapper").show()
						                        						   						   
						   

                    });
					
					
					$('li.more-menu').mouseleave(function() {					
                        $(this).find(".menu-dropdown-wrapper").hide();												   
                    });	
					
});					