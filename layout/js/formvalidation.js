$(document).ready(function(){	
	
	     


		
    $("#form-to-validate").validator({
        position: 'bottom left',	
        offset: [3, -10],
        inputEvent:	'null',
        message: '<div><em/></div>' // em element is the arrow
    });
	
    $.tools.validator.fn("[minlength]", "Please enter a value that is at least $1 characters.", function(input) {		
        var pass, minlength = input.attr("minlength"), length = $(input).val().length; 			
        if (length < minlength) {			
            $(input).addClass("invalid");			
            pass = [minlength];			
        } else {			
            $(input).removeClass("invalid");			
            pass = true;				
        }
        //console.log("minlength:",length,">",minlength,"?",pass);			
        return pass; 
    });

    $.tools.validator.fn("[data-equals]", "Value not equal with the $1 field", function(input) {
        var name = input.attr("data-equals"),
        field = this.getInputs().filter("[name=" + name + "]");
        return input.val() == field.val() ? true : [name];
    });
    /*	
	
	$.tools.validator.fn("select[required]", "Please make a selection.", function(input, value) {			
	// check select's value
	var pass = (value != "Select") ? true : false;			
	// add "invalid" if test fails
	pass ? $(input).removeClass("invalid") : $(input).addClass("invalid");
	return pass;
});
*/

    $.tools.validator.fn("select[required=required]", function(input, value) {
        // If the first item in the list is selected return FALSE
        var pass = true;
        ;
        if (input[0].options[0].selected){
            pass = false;
            $(input).addClass("invalid");
        }
        else{
            $(input).removeClass("invalid")
        }
    
        return pass;
    });



    // generic validator for required input fields to work with validator() & [placeholder]
    $.tools.validator.fn("input[required]", function(input, value) {	
        var pass;
        if ((value == "") || (value == $(input).attr("placeholder"))) {			
            $(input).addClass("invalid");			
            pass = false;			
		
        } else {			
            $(input).removeClass("invalid");					
            pass = true;					
        }

        return pass;
    });

    // password check for spaces		
    $.tools.validator.fn("[type='password']", "Please do not use spaces.", function(input) {		
        var pass; 			
        if ($(input).val().match(/ /g)) {			
            $(input).addClass("invalid");			
            pass = false;			
        } else {			
            $(input).removeClass("invalid");	
            pass = true;				
        }		
        return pass; 
    });
	
    $.tools.validator.fn("[type='custom-checkbox']", "Please select the checkbox", function(input) {
  		
	
        var pass = true;
	
        if (!$(input).hasClass("custom-checkbox-checked")){	
            pass = false;
            $(input).addClass("invalid");
        }
        else{
            $(input).removeClass("invalid");
        }
    
        return pass;
  
    });



    $("#form-to-validate").submit(function () {

        if (this.checkValidity()) {                
					
					
        }                
        else{
				
        }
        
    });
        
		
		
});