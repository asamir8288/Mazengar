$(document).ready(function(){
    
    if($('.product_id').val() != ''){
        $.get(site_url() + 'product/get_menu_subs/' + $('.sub_id').val(), function(data){
            if(data){
                $('.menu_subs').append(data);
                $('.shopcategory').attr('name', 'sub_id');
            }else{
                $('.shopcat').hide();
            }            
        });
    }else{
        $('.shopcategory').attr('name', 'sub_id_unuse');
        $('.shopcategory').last().attr('name', 'sub_id');
    }
        
       
    $('.shopcategory').live("change",function(){            
        $($(this)).nextAll().remove();
        $.get(site_url() + 'product/get_menu_subs/' + $(this).val(), function(data){
            if(data){
                $('.menu_subs').append(data);
                $('.shopcategory').attr('name', 'sub_id_unuse');                    
            }                
        });
        $('.shopcategory').last().attr('name', 'sub_id');
    });
    
    $(".custom-checkbox").click(function(){	  
        if($(this).hasClass("custom-checkbox-checked")){
            $(this).removeClass("custom-checkbox-checked");
            $('.hidden-availability').val('no');
        }else{
            $(this).addClass("custom-checkbox-checked");
            $('.hidden-availability').val('yes');
        }            
    });
	
    $('.upload-gallery-image-anchor').livequery('click',function(){
        var imageToChange = $(this).parent();
        $('#myModal').reveal();
        $(".modal-innercontent").remove();	
					
        $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
		
														  
        var myID = $(".modal-innercontent").find("a").attr('id'); 
					
        var parentAppend = $(".modal-innercontent");
					
        $(".select-files-anchor").uploadify ({
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    : site_url() + '/upload.php',			
            'onComplete' : function(event,queueID,fileObj,response,data) {
					
							
                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {								  
								
                    parentAppend.find('object').eq(0).remove();
								
								
                    $(".gallery-image").remove();
                    $(".upload-gallery-image-anchor").remove();

								
                    imageToChange.append('<img class="gallery-image" src="'+ site_url() +'uploads/' + fileObj.name + '" /><a class="upload-gallery-image-anchor" id="gallery-img">Upload Another Image</a>');                    													
                    $('.main_img').val(fileObj.name);
								 
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
        var myID = $(this).attr('id'); // grab id of the clicked fileInput button (e.g. 'fileInput_45')
        var parentAppend =$(this).parent() ;
        
        $(this).uploadify ({            
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    :  site_url() + 'upload.php',			
            'onComplete' : function(event,queueID,fileObj,response,data) {

                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {                    
                    parentAppend.find('object').eq(0).hide();
                    parentAppend.append('<div class="uploaded-img-wrapper"><input type="hidden" name="additional_imgs[]" value="' + fileObj.name + '" /><img src="'+site_url() +'uploads/' + fileObj.name + '"/></div>');                    					
                }else{
                    alert('Upload Failure: Only images with the following extenstions jpg, jpeg, png, gif are allowed.');
                }
            },
            'cancelImg' : site_url() + 'layout/js/cancel.png',
					
            'sizeLimit' : '2000000', //Max Size 1 MB
            'folder'    : site_url() + 'uploads',
            'fileDesc': 'Only images allowed',
            'fileExt' : '*.jpg;*.png;*.jpeg;*.gif',
            'multi' : false,
            'auto'      : true

        });
    });
	
	$(".draggable-list").dragsort({ dragSelector: ".box", itemSelector:"li.drag-list-item", dragBetween: true, placeHolderTemplate: "<li class='placeHolder drag-list-item'>	<div class='box'>	</div></li>" });		
});
