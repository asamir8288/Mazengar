//Script For the Header Drop Down Menu
	  
$(document).ready(function(){
    $(".inactive-menu-wrapper").live("mouseover",function(){
        $(this).find(".activate-menu-anchor").show();
    });
   
    $(".inactive-menu-wrapper").live("mouseout",function(){
        $(this).find(".activate-menu-anchor").hide();
    });
   
    $(".activate-menu-anchor").live("click",function(){
        var mainMenuName = $(this).parent().find("span").text();
        var mainMenuType = $(this).parent().find(".inactive-menu-type").val();
        $(this).parent().before('<div class="mainmenu-item-wrapper"><img class="mainmenu-image" src="'+ site_url() +'layout/images/mainmenu-image.png" /><div class="mainmenu-item"><img src="'+ site_url() +'layout/images/cleardot.gif" alt=""><input type="hidden" class="menu-type" value="'+ mainMenuType +'" /><input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="'+mainMenuName+'"/><ul class="mainmenu-icons-list">									<li class="mainmenu-icon open-image-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon add-submenu-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon delete-menu-icon"></li></ul></div>				<div class="move-menu-wrapper">			<a class="move-menu-up">Move up</a>			<a class="move-menu-down">Move Down</a>			</div>	</div>');																	
        $(this).parent().remove();
    });

    $(".move-menu-down").live("click",function(){		
        $(this).parent().parent().clone().hide().insertAfter($(this).parent().parent().next()).show();	
        $(this).parent().parent().remove();		
        $(".move-menu-wrapper").hide();
    });

    $(".move-menu-up").live("click",function(){
        $(this).parent().parent().clone().hide().insertBefore($(this).parent().parent().prev()).show();
        $(this).parent().parent().remove();		
        $(".move-menu-wrapper").hide();
									
    });
			   
    //submenu-item-wrapper
			   
    $(".mainmenu-item-wrapper").live("mouseover",function(){							
        $(this).find(".move-menu-wrapper").eq(0).show();   
        if($(this).prev().size() == 0)
        {
            $(".move-menu-up").eq(0).hide();
            $(".move-menu-down").eq(0).show();
        }			
        else if ($(this).next().size() == 0){
            $(".move-menu-up").eq(0).show();
            $(".move-menu-down").eq(0).hide();				
        }
        else{
            $(".move-menu-up").eq(0).show();
            $(".move-menu-down").eq(0).show();
        }
    });

    $(".mainmenu-item-wrapper").live("mouseout",function(){
        $(this).find(".move-menu-wrapper").hide();
    });

    $(".add-submenu-icon").live("click",function(){			
        if($(this).parent().parent().parent().find(".submenu-item-container").eq(0).length == 0)
        {
            //This Menu doesn't have Submenu, Add a Submenu container and add a Menu Item In it
            $(this).parent().parent().parent().append('<div class="submenu-item-container"><div class="submenu-item-wrapper first-submenu-item"><img class="mainmenu-image" src="'+ site_url() +'layout/images/mainmenu-image.png" /><div class="mainmenu-item"><img src="'+ site_url() +'layout/images/cleardot.gif" alt=""><input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Enter Name"/><ul class="mainmenu-icons-list">									<li class="mainmenu-icon open-image-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon add-submenu-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon delete-menu-icon"></li></ul></div>	</div></div>');
        }

        //This Menu Already has a Submenu, So append a new Menu Item
        else{						
            $(this).parent().parent().parent().find(".submenu-item-container").eq(0).append('<div class="submenu-item-wrapper"><img class="mainmenu-image" src="'+ site_url() +'layout/images/mainmenu-image.png" /><div class="mainmenu-item"><img src="'+ site_url() +'layout/images/cleardot.gif" alt=""><input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Enter Name"/><ul class="mainmenu-icons-list">									<li class="mainmenu-icon open-image-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon add-submenu-icon"></li><li class="mainmenu-list-seperator"></li><li class="mainmenu-icon delete-menu-icon"></li></ul></div></div>');														
        }
    });
    
    $(".delete-menu-icon").live("click",function(){			
        var object = $(this).parent().parent().parent();												
        if(object.hasClass("first-submenu-item")){						
            $(this).parent().parent().parent().next().addClass("first-submenu-item");
        }
        
        if($(this).parent().parent().parent().next().length == 0 && $(this).parent().parent().parent().prev().attr("class")== undefined){		
            // Submenu Container when it's the last menu item								
            $(this).parent().parent().parent().parent().parent().find(".submenu-item-container").remove();				
        }
        
        if( (object.attr("class") =="mainmenu-item-wrapper"))
        {					
            var mainMenuName = object.find(".mainmenu-name").eq(0).val();
            var mainMenuType = object.find(".menu-type").eq(0).val();
			
            object.before('<div class="inactive-menu-wrapper"><div class="inactive-menu-item"><input type="hidden"  class="inactive-menu-type" value="'+mainMenuType+'"/><span>'+ mainMenuName +'</span></div><a class="activate-menu-anchor">Activate Menu</a></div>');
            object.remove();																
        }				
        else{				
            object.fadeOut(550);		
            setTimeout(function() {
                object.remove();					  
            }, 550);	
        }
    });

    $('.mainmenu-name').keypress(function(e){
        if(e.which == 13){
            $(this).blur();
            e.preventDefault();
        }
    });				
});

//forsubmitting action
$(document).ready(function(){						
    function drawSubContainer(indexString,container)
    {					  
        if(container.size() > 0)
        {            
            container.children(".submenu-item-wrapper").each(function(i){
                tempString =indexString +"[sub]["+i+"]";			
                $("#submit-area").append('<input type="hidden" name="'+tempString+'[name]" value="'+$(this).find(".mainmenu-name").eq(0).val()+'">');	
                //New Code
                $("#submit-area").append('<input type="hidden" name="'+tempString+'[img]" value="'+$(this).find(".mainmenu-image").eq(0).attr("src")+'">');
                drawSubContainer(tempString,$(this).find(".submenu-item-container").eq(0));								
            });
        }
    }
    
    $('#myButton').live("click",function(){        
        var tempParentIndex = 0;
        $(".mainmenu-item-wrapper").each(function(parentIndex){	   
            var indexString = "";					
            parentString ="menu["+parentIndex+"]";
            
            $("#submit-area").append('<input type="hidden" name="'+parentString+'[name]" value="'+$(this).find(".mainmenu-name").eq(0).val()+'">');
            //New Code
            $("#submit-area").append('<input type="hidden" name="'+ parentString +'[img]" value="'+$(this).find(".mainmenu-image").eq(0).attr("src")+'">');
            $("#submit-area").append('<input type="hidden" name="' + parentString +'[type]" value="'+$(this).find(".menu-type").eq(0).val()+'">'); 
					
            var SubContainer = $(this).find(".submenu-item-container").eq(0);
            //If it has a submenu							
            if(SubContainer.size() > 0)
            {					
                SubContainer.children(".submenu-item-wrapper").each(function(subIndex){				
                    indexString = parentString + "[sub]["+subIndex+"]";                    
                    $("#submit-area").append('<input type="hidden" name="'+indexString+'[name]" value="'+$(this).find(".mainmenu-name").eq(0).val()+'">');
                    //New Code
                    $("#submit-area").append('<input type="hidden" name="'+indexString+'[img]" value="'+$(this).find(".mainmenu-image").eq(0).attr("src")+'">');
																	
                    drawSubContainer(indexString, $(this).find(".submenu-item-container").eq(0));						
                });						
            }					
            tempParentIndex = parentIndex;							
        });

        $(".inactive-menu-wrapper").each(function(inactiveIndex){
            var tempIndex = tempParentIndex + inactiveIndex + 1;					
            indexString = "inactivemenu["+ tempIndex + "]";
            $("#submit-area").append('<input type="hidden" name="'+indexString+'[name]" value="'+$(this).find("span").eq(0).text()+'">');
            $("#submit-area").append('<input type="hidden" name="'+indexString+'[type]" value="'+$(this).find(".inactive-menu-type").eq(0).val()+'">');								
        });
        $('#myForm').submit();
    });
    
    $('form').submit(function() {
        return true;
    });

    $('.open-image-icon').livequery('click',function(){
        var imageToChange = $(this).parent().parent().parent();
        $('#myModal').reveal();
        $(".modal-innercontent").remove();					
        $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
														  
        var myID = $(".modal-innercontent").find("a").attr('id'); 
        var parentAppend = $(".modal-innercontent");
        
        $(".select-files-anchor").uploadify ({
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    : site_url() + 'upload.php',			
            'onComplete' : function(event,queueID,fileObj,response,data) {
                var img = response.substring(response.lastIndexOf('/') + 1);
                
                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {		
                    imageToChange.find(".mainmenu-image").eq(0).remove();
                    imageToChange.prepend('<img class="mainmenu-image" src="uploads/' + img + '" />');		
                    $(".reveal-modal-bg, .reveal-modal").fadeOut(200);     
                    setTimeout(function() {		
                        imageToChange.find(".mainmenu-image").eq(0).effect( "highlight", 
                        {
                            color:"#FFF4A5"
                        }, 2500 );		
                    }, 200);												
                }else{
                    alert('Upload Failure: Only images with the following extenstions jpg, jpeg, png, gif are allowed.');
                }
            },
            'cancelImg' : site_url() + 'layout/js/cancel.png',
            'sizeLimit' : '1000000', //Max Size 1 MB
            'folder'    : 'uploads',
            'fileDesc': 'Only images allowed',
            'fileExt' : '*.jpg;*.png;*.jpeg;*.gif',
            'multi' : false,
            'auto'      : true
        });
    });
});