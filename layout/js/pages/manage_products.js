$(document).ready(function(){        
    $('.publish-icon').live('click', function(e){
        e.preventDefault();
        var current_element = $(this);
        var prod_id = $(this).attr('id');
        $.get(site_url()+"product/activate_deactivate/"+prod_id, function(data){
            if(data.status){
                current_element.addClass('active_publish-icon');
            }else{
                current_element.removeClass('active_publish-icon');
            }
        },
        'json');                        
    });
        
    $('.delete-icon').live('click', function(e){
        e.preventDefault();
        var current_element = $(this);
        var prod_id = $(this).attr('id');
        $.get(site_url()+"product/delete_product/"+prod_id, function(data){
            if(data == 'success'){
                current_element.parent().parent().parent().fadeOut(); 
            }                
        },'json');                      
    });
	
	$(".draggable-list").dragsort({ dragSelector: ".box", itemSelector:"li.drag-list-item", dragBetween: true, placeHolderTemplate: "<li class='placeHolder drag-list-item'>	<div class='box'>	</div></li>" });		
});