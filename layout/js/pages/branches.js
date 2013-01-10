$(document).ready(function(){
	  


    $('.upload-image-anchor').livequery('click',function(){
					
        var imageToChange = $(this).parent();
        $('#myModal').reveal();
        $(".modal-innercontent").remove();	
					
        $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
		
														  
        var myID = $(".modal-innercontent").find("a").attr('id'); 
					
        var parentAppend = $(".modal-innercontent");
					
        $(".select-files-anchor").uploadify ({
            'uploader'  : site_url() + 'layout/js/uploadify.swf',
            'script'    : site_url() + 'upload.php',			
            'onComplete' : function(event,queueID,fileObj,response,data) {
					
							
                if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                {								  
								
                    parentAppend.find('object').eq(0).remove();
                    $(".main-image").remove();
                    $(".upload-image-anchor").remove();
								
                    $(".main_img").val(fileObj.name);
								
                    imageToChange.append('<img class="main-image" src="'+ site_url() +'uploads/' + fileObj.name + '" /><a class="upload-image-anchor">Upload Another Image</a>');                    													
				
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
				
		
	  
});