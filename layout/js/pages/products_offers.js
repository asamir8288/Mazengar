$(document).ready(function(){
    
    $(".custom-checkbox").click(function(){	  
        if($(this).hasClass("custom-checkbox-checked")){
            $(this).removeClass("custom-checkbox-checked");
            $('.hidden-availability').val('no');
        }else{
            $(this).addClass("custom-checkbox-checked");
            $('.hidden-availability').val('yes');
        }            
    });
	  
    $("form").validator({
        position: 'bottom left',	
        offset: [3, -10],
        inputEvent:	'null',
        message: '<div><em/></div>' // em element is the arrow
    });
	
    $( "#startdate" ).datepicker();
    $( "#enddate" ).datepicker();

    $('.delete-product-icon').live("click",function(){				
        var myObject = $(this).parent().parent().parent();

        myObject.fadeOut(700);		
        setTimeout(function() {
            myObject.remove();		

            if($(".product-item-wrapper").size() == 0)
            {
                $(".no-items-yet").fadeIn(300);
            }
        }, 700);
    });	

    $('.add-product-caption-icon').live("click",function(){							
        $(this).parent().parent().find(".caption-area-wrapper input").eq(0).fadeIn(100);			
    });	

    $('.add-text-icon').live("click",function(){
        $(".no-items-yet").hide();
        $(".draggable-list").append('<li class="drag-list-item"><div class="product-item-wrapper"><textarea class="products-textarea"></textarea><ul class="product-item-action-list">				<li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li><li class="product-item-icon delete-product-icon"><a>Delete</a></li><li title="Drag Me" class="product-item-icon move-product-icon"><a >Move</a></li>					</ul>				<div class="caption-area-wrapper"><input type="text" placeholder="Caption" name="text_caption[]" maxlength="70"/></div>	</div></li>');                    					
		
        var scrollOffset = 300;
        if($('.product-item-wrapper').size() < 2){
            scrollOffset = 500;
        }

        $('html, body').animate({
            scrollTop: $(".save-products-button-wrapper").offset().top - scrollOffset
        }, 900);

        $('.products-textarea').last().effect( "highlight", 
        {
            color:"#FFF4A5"
        }, 2000 );
						
        $('.products-textarea').last().focus();
    });	


    $('.add-image-icon').live("click",function(){			
        $(".no-items-yet").hide();		
        var imgID = $('.products-image-upload').size()+1;        
        $(".draggable-list").append('<li class="drag-list-item"><div class="product-item-wrapper"><div class="products-image-upload"><a class="large-btn-products gray-bg-products upload-img-btn" id="img_btn_'+imgID+'">UPLOAD IMAGE</a>			</div><ul class="product-item-action-list">				<li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li><li class="product-item-icon delete-product-icon"><a>Delete</a></li>	<li title="Drag Me" class="product-item-icon move-product-icon"><a >Move</a></li>						</ul><div class="caption-area-wrapper"><input type="text" name="image_caption[]" placeholder="Caption" maxlength="70"></div>				</div></li>');                    					
			
        var scrollOffset = 300;
        if($('.product-item-wrapper').size() < 2){
            scrollOffset = 500;
        }
	  
        $('.products-image-upload').last().effect( "highlight", 
        {
            color:"#FFF4A5"
        }, 2000 );

        $('html, body').animate({
            scrollTop: $(".save-products-button-wrapper").offset().top - scrollOffset
        }, 900);
    });	

    $('.add-video-icon').live("click",function(){			
        $(".no-items-yet").hide();					
        $(".draggable-list").append('<li class="drag-list-item"><div class="product-item-wrapper"><div class="products-video-upload"><a class="large-btn-products gray-bg-products  upload-video-btn">YOUTUBE LINK</a>			</div><ul class="product-item-action-list">				<li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li><li class="product-item-icon delete-product-icon"><a>Delete</a></li><li title="Drag Me" class="product-item-icon move-product-icon"><a >Move</a></li>						</ul><div class="caption-area-wrapper"><input type="text" placeholder="Caption" name="video_caption[]" maxlength="70"></div></div></li>');
        
        var scrollOffset = 300;
        if($('.product-item-wrapper').size() < 2){
            scrollOffset = 500;
        }
						
        $('html, body').animate({
            scrollTop: $(".save-products-button-wrapper").offset().top - scrollOffset
        }, 900);
					
        $('.products-video-upload').last().effect( "highlight", 
        {
            color:"#FFF4A5"
        }, 2000 );
    });	

    $('.upload-video-btn').live("click",function(){
        $(this).parent().append('<div class="upload-video-link-wrapper"><p>Please Enter Youtube Video Link</p><input type="text" class="video-link-text" /><a  class="large-btn gray-bg-products add-video-btn">Add Video</a></div>');
        $(this).parent().find('.upload-video-link-wrapper input').focus();			
        $(this).hide();
    });	


    $('.add-video-btn').live("click",function(){
        var youtubeLink = $(this).parent().find('.video-link-text').val();			
        var endIndex =youtubeLink.length;
        var startIndex = youtubeLink.indexOf("?v=") +3;
        var youtubeLinkValue = youtubeLink.substring(startIndex, endIndex);
        var finalLink = "http://www.youtube.com/v/" +youtubeLinkValue;
        $(this).parent().parent().append('<object class="youtube-video-frame" width="470" height="345"><param name="movie" value="'+ finalLink +'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'+ finalLink +'" type="application/x-shockwave-flash" width="470" height="345" allowscriptaccess="always" allowfullscreen="true"></embed></object>');
        $(this).parent().hide();
    });	

    $('.caption-area-wrapper input').keypress(function(e){
						
        if(e.which == 13){
            $(this).blur();
            e.preventDefault();
        }
    });

    $('.upload-product-image-anchor').livequery('click',function(){
        var imageToChange = $(this).parent();
        $('#myModal').reveal();
        $(".modal-innercontent").remove();					
        $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
									  
        var myID = $(".modal-innercontent").find("a").attr('id'); 
        var parentAppend = $(".modal-innercontent");

        $(".select-files-anchor").uploadify ({
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    : site_url() +'upload.php',				
            'onComplete' : function(event,queueID,fileObj,response,data) {
                var img = response.substring(response.lastIndexOf('/') + 1);                
                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {
                    parentAppend.find('object').eq(0).remove();
                    $(".product-image").remove();
                    $(".upload-product-image-anchor").remove();
								
                    $(".main_img").val(img);
								
                    imageToChange.append('<img class="product-image"  src="'+site_url() +'uploads/' + img + '" /><a class="upload-product-image-anchor" id="offer-img">Upload Another Cover Image</a>');                    													
				
                    $(".reveal-modal-bg, .reveal-modal").hide();     
                    $('#myModal').css({
                        'top': '150px'
                    }) ;								
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

    $('.upload-img-btn').livequery('click',function(){
        var imageToChange = $(this).parent();
        $('#myModal').reveal();
        $(".modal-innercontent").remove();	
					
        $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
        
        var myID = $(".modal-innercontent").find("a").attr('id'); 	
        var parentAppend = $(".modal-innercontent");
        
        $(".select-files-anchor").uploadify ({
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    : site_url() +'upload.php',		
            'onComplete' : function(event,queueID,fileObj,response,data) {
                var img = response.substring(response.lastIndexOf('/') + 1);
                
                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {
                    imageToChange.find(".upload-img-btn").eq(0).remove();
                    imageToChange.append('<div class="uploaded-img-wrapper"><img  src="'+site_url() +'uploads/' + img + '"/></div>');    
								
				
                    $(".reveal-modal-bg, .reveal-modal").hide();     
                    $('#myModal').css({
                        'top': '150px'
                    });					
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
				  
    $(".draggable-list").dragsort({
        dragSelector: ".move-product-icon", 
        itemSelector:"li.drag-list-item", 
        dragBetween: true, 
        placeHolderTemplate: "<li class='placeHolder drag-list-item'>	<div class='product-item-wrapper'>	</div></li>"
    });		
						
    $('.submit-btn').live("click",function(){		
        $("#submit-area").html("");
        var tempIndex = 0;
        $(".drag-list-item").each(function(Index){					   	
            if($(this).find(".products-textarea").eq(0).size() == 1)					
                if($(this).find(".products-textarea").eq(0).val() != "")
                {
                    $("#submit-area").append('<input type="hidden" name="text-order[' + tempIndex +']" value="'+$(this).find(".products-textarea").eq(0).val()+'">'); 							 
                    tempIndex++;
                }
                
            if($(this).find(".products-image-upload").eq(0).size() == 1)
                if($(this).find(".uploaded-img-wrapper img").eq(0).size() == 1)
                {
                    $("#submit-area").append('<input type="hidden" name="img-order[' + tempIndex +']" value="'+$(this).find(".uploaded-img-wrapper img").eq(0).attr("src")+'">'); 							 
                    tempIndex++;
                }
                
            if($(this).find(".products-video-upload").eq(0).size() == 1)
                if($(this).find("param[name=movie]").eq(0).size() == 1)
                {					
                    $("#submit-area").append('<input type="hidden" name="video-order[' + tempIndex +']" value="'+$(this).find("param[name=movie]").eq(0).val()+'">'); 							 					
                    tempIndex++;
                }
															
        });				
    });
    
    $('form').submit(function() {    
        return true;
    });
			
	  
});