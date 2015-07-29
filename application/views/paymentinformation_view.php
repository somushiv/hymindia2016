<div class="row ">

    <?php if (isset($profile)) echo $profile; ?>
    <style>
    	td.rightalign{
    		text-align:right;
    	}
    </style>
    <div class="col-xs-4 col-sm-4">
       <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading">Payments Heads</div>

                <div class="panel-body">
                	<table  class="table table-bordered">
                		<tr>
                			<th>Sl.No</th>
                			<th>Payment Head</th>
                			<th>Amount</th>
                		</tr>
                		<tr>
                			<td>1</td>
                			<td>Event Registrion</td>
                			<td class="rightalign"><?php echo number_format($payment_cost['event_registration'],2)?></td>
                		</tr>
                			<tr>
                			<td>2</td>
                			<td>Tours (Pre/Post)</td>
                			<td class="rightalign"><?php echo number_format($payment_cost['tour_total_cost'],2); ?></td>
                		</tr>
                			<tr>
                			<td>3</td>
                			<td>Day Trip</td>
                			<td class="rightalign"><?php echo number_format($payment_cost['daytourTotalCost'],2); ?></td>
                		</tr>
                		<tr>
                			<td>4</td>
                			<td>Drop/Pickup</td>
                			<td class="rightalign"> <?php echo number_format($payment_cost['trans_details'],2); ?></td>
                		</tr>
                			<tr>
                			<td>5</td>
                			<td>Accommodation</td>
                			<td class="rightalign"><?php echo number_format($payment_cost['acc_cost_total'],2); ?></td>
                		</tr>
                		<tr style="background-color:#F5F4F4">
                			<td></td>
                			<td>Total Amount</td>
                			<td class="rightalign"><?php echo number_format($totalCost,2);  ?></td>
                		</tr>
                		<tr style="background-color:#cccccc">
                			<td></td>
                			<td>Amount Paid</td>
                			<td class="rightalign"><?php echo number_format($amount_paid,2);  ?></td>
                		</tr>
                	</table>
                	
                </div>
         </div>
       
    </div>
	<div class="col-xs-5 col-sm-5">
        <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading">Payment Refrence</div>
			<form action="/paymentinfo/updatefeesdata" method="post" id="myform" name="myform" class="formdata" role="form" data-toggle="validator">
                <div class="panel-body">
                	<table class="table table-bordered">
                		
<tr>
      <td><label> Payment Mode: </label></td>
     <td> <select name="paymentmode" id="paymentmode" class="mid">
        <option value="0">-- Select --</option>
        <option value="1">Cheque</option><option value="2">Cash</option><option value="3">DD</option><option value="4">NEFT</option><option value="5">Bank</option><option value="6">RTGS</option>
      </select></td>
</tr>
        <tr><td><label> <span class="label label-danger">*Reference Number: </span></label></td>
        <td><input name="paymentrefrence" value="" class=" form-control mid" type="input"><div class="help-block with-errors"></div></td></tr>
        
        <tr><td><label> Amount : </label></td>
        <td><input name="amount" class="form-control mid" value="<?php echo number_format($amount_to_be_paid,2); ?>" type="text"></td></tr>
        
      
        
       <tr><td> <label> Dated: </label></td>
        <td>
        <input name="dated" value="" class="form-control mid hasDatepicker " id="dated" type="input"></td></tr>
        
        <tr><td><label> <span class="label label-danger">*Bank Name:</span> </label></td>
        <td>
        <div class="input-group">
        <input name="bankname" value="" class="mid form-control" type="input" ></td></tr>
        </div>
       <tr><td><label> City: </label></td>
        <td>
        <input name="bankcity" value="" class="form-control mid" type="input"><div class="help-block with-errors"></div></td></tr>
        
       <tr><td> <label> Branch: </label></td>
        <td>
        <input name="bankbranch" value="" class="form-control mid" type="input"><div class="help-block with-errors"></div></td></tr>
        
        <tr><td><label> Notes: </label></td>
        <td>
        <textarea rows="5" class="mid form-control" name="notes "></textarea></td></tr>
        
       
      <input name="totalprice" value="<?php echo $totalCost; ?>" type="hidden">
      
      <tr><td colspan="2"><input value="Save" class="button medium white text-right" type="submit"> </td>
	</tr>

                	</table>
                </div>
                </form>
        </div>
       
    </div>

   
</div>
