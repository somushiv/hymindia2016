     var totalprice=0;
$(document).ready(function () {
	$(".daytourselection").click(function(){
    	var objref=$(this);
    	var objectname=objref.attr("name");
    	
    	
    	var eventcost=objref.attr("cost");
    	
    	if (objref.is(":checked")){
    		updatecostui(objectname,eventcost,true);
    	}else{
    		updatecostui(objectname,eventcost,false);
    	}
	});
});
function updatecostui(objectname,eventcost,mode){
	var ctlname="."+objectname+"-display";
	console.log(eventcost);
	var costt=parseInt(eventcost);
if (mode){
		
		$(ctlname).text(getIndianCurrencyFormat(eventcost));
		totalprice=totalprice+costt;
	}else{
		$(ctlname).text("");
		totalprice=totalprice-costt;
		removedata(objectname);
	}
$("#total-sum").text(getIndianCurrencyFormat(totalprice));
}
function getIndianCurrencyFormat(total) {
    x = total.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

    return res+".00";
}
function removedata(objectname){
	$.ajax({
		url:"/daytours_registration/removedata",
		type:"POST",
		data:{objectname:objectname},
		success: function(data) {
			console.log(data);
			$(".date-"+data).val("0");
		}
	});
}