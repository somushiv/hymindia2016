//Delegates Registration Form JS file
$( document ).ready(function() {
	//$(".tourtable").hide();
	$("#tour_1").click(function(){
		var datvalue=$(this).val().length;
		 
		if($(this).is(':checked')){
			console.log("I am zero");
			$("#tourmode_1").show();
		}else{
			$("#tourmode_1").hide();
		}
	});
	$("#tour_2").click(function(){
		var datvalue=$(this).val().length;
		 
		if($(this).is(':checked')){
			 
			$("#tourmode_2").show();
		}else{
			$("#tourmode_2").hide();
		}
	});
});