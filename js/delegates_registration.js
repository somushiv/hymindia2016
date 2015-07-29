//Delegates Registration Form JS file
$( document ).ready(function() {
$('#delegates_mode').hide();

$('#delegates_country').change(function(){
	
	var countryValue=this.value;
	
	if (countryValue=='IN'){
		$('#delegates_mode').val(1);
	}else{
		$('#delegates_mode').val(2);
	}
	
});

$("#delegates_firstname").on('keyup blur', function (e) {
    $("#spanLengthValidation").text("");
    
    $.get("/getTime", function (delegate_registration) {
          // update the textarea with the time
          alert(delegate_registration);
          $("#delegates_firstname").html("Time on the server is:" + time);
        });
});

});
