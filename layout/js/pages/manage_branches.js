$(document).ready(function(){        
	
	$(".draggable-list").dragsort({ dragSelector: ".box", itemSelector:"li.drag-list-item", dragBetween: true, placeHolderTemplate: "<li class='placeHolder drag-list-item'>	<div class='box'>	</div></li>" });		
});