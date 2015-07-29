$(document).ready(function () {
	$("#delegates_emailid").blur(function() {
        //gets the value of the field
        var email = $("#delegates_emailid").val();
 
        //here would be a good place to check if it is a valid email before posting to your db
 
        //displays a loader while it is checking the database
        $("#emailError").html('<img alt="" src="/images/ajax-loader.gif" />');
 
        //here is where you send the desired data to the PHP file using ajax
        $.post("/delegate_registration/validedatemail", {email:email},
            function(result) {
        	var eMail=$("#delegates_emailid").val();
                if(result == 1) {
                	
                    //the email is available
                    $("#emailError").html(eMail+" already Registered with us ");
                    $("#btn_add").hide();
                }
                else {
                    //the email is not available
                    $("#emailError").html("Email Can be Registered");
                    $("#btn_add").show();
                }
            });
     });
});
