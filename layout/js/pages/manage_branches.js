$(document).ready(function(){        
    $('.publish-icon').live('click', function(e){
        e.preventDefault();
        var current_element = $(this);
        var branch_id = $(this).attr('id');
        $.get(site_url()+"branch/activate_deactivate/"+branch_id, function(data){
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
        var branch_id = $(this).attr('id');
        $.get(site_url()+"branch/delete_branch/"+branch_id, function(data){
            if(data == 'success'){
                current_element.parent().parent().parent().fadeOut();
                if($(".draggable-list").children().length <= 1){
                    $('.manage_lists').hide();
                }
            }                
        },'json');                      
    });
    
    $(".draggable-list").dragsort({
        dragSelector: ".box", 
        itemSelector:"li.drag-list-item", 
        dragBetween: true, 
        placeHolderTemplate: "<li class='placeHolder drag-list-item'>	<div class='box'>	</div></li>"
    });		
});