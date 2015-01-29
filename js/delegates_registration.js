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
});
