     var totalprice=0;
$(document).ready(function () {

    $(".attendees").change(function(){
    	var objref=$(this);
    	var package_details_id=objref.attr("package_details_id");
    	//var relitionship_id=objref.attr("relitionship_id");
    	var eventcost_s=objref.attr("eventcost_s");
    	var eventcost_d=objref.attr("eventcost_d");
    	var num_people=objref.val();
    	
    	
    	 
    		updatecostui(package_details_id,eventcost_s,eventcost_d,parseInt(num_people));
    	 
    });
    $(".attendees2").change(function(){
    	var objref=$(this);
    	var package_details_id=objref.attr("package_details_id");
    	//var relitionship_id=objref.attr("relitionship_id");
    	var eventcost_s=parseInt(objref.attr("eventcost_s"));
    	
    	var num_people=parseInt(objref.val());
    	var ctlname=".dep-"+package_details_id+"-";
    	deleTotalCost=eventcost_s*num_people;
    	
    	$(ctlname).text(getIndianCurrencyFormat(deleTotalCost));
    		
    	 
    });
   
});
function updatecostui(package_details_id,eventcost_s,eventcost_d,num_people){
	var ctlname=".dep-"+package_details_id+"-";
	var deleTotalCost=0;
	if (num_people>0){
	switch(num_people){
	case 1:
			deleTotalCost=eventcost_s;
			break;
	case 2:
			deleTotalCost=eventcost_d;
			break;
	default:
			number_people=num_people-2;
			deleTotalCost=parseInt(eventcost_d)+(number_people*parseInt(eventcost_s));
	}
	
	
	console.log(ctlname);
	var costPrice=parseInt(deleTotalCost);
	//totalprice=totalprice+costPrice;
	}
	
	$(ctlname).text(getIndianCurrencyFormat(deleTotalCost));	
		
		
	
	$("#sum").text(getIndianCurrencyFormat(totalprice));
	//$("#total-sum").val(totalprice);
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
