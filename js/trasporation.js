$(document).ready(function () {
	$(".container1").hide();

    $('#delegate_pickup').click(function () {
        if ($(this).is(':checked')){
        	$(".pickupinfo").show();
        }else{
        	$(".pickupinfo").hide();
        }
    });
    
    $('#delegate_drop').click(function () {
        if ($(this).is(':checked')){
        	$(".dropinfo").show();
        }else{
        	$(".dropinfo").hide();
        }
    });
    var refrencelabel=['Refrence No',"Train Number","Flight Number","Bus/Car/other"];
    $('#delegates_pickup_mode').change(function () {
    	var selectedVal=$(this).val();
    	console.log(refrencelabel[selectedVal]);
    	$("#picup_refrence_label").text(refrencelabel[selectedVal]);
    });
    $('#delegates_departure_mode').change(function () {
    	var selectedVal=$(this).val();
    	console.log(refrencelabel[selectedVal]);
    	$("#departure_refrence_label").text(refrencelabel[selectedVal]);
    });

});