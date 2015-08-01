<div class="row ">

    <?php if (isset($profile)) echo $profile; ?>
    <style>
    	td.rightalign{
    		text-align:right;
    	}
    </style>
    <div class="col-xs-4 col-sm-4">
       <div class="panel panel-default pwd-reset-block">
       		<?php echo $payment_cost; ?>
         </div>
       
    </div>
	<div class="col-xs-5 col-sm-5">
        <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading">Payment Refrence</div>
			<form action="/paymentinfo/updatefeesdata" method="post" id="myform"
			 name="myform" class="formdata" role="form" data-toggle="validator">
                <div class="panel-body">
                	<table class="table table-bordered">
                		
<tr>
      <td><label> Payment Mode: </label></td>
     <td> <select name="paymentmode" id="paymentmode" class="mid" required  data-error='Select title'">
        <option value="0">-- Select --</option>
        <option value="1">Cheque</option><option value="2">Cash</option>
        <option value="3">DD</option><option value="4">NEFT</option><option value="5">Bank</option><option value="6">RTGS</option>
      </select>
      <span class="help-block with-error"></span> </td>
</tr>
        <tr><td><label> <span class="label label-danger">*Reference Number: </span></label></td>
        <td><div></div><input name="paymentrefrence" value="" class=" form-control mid" type="input" required 
         data-error='Payment Refrence Number is required'"><div class="help-block with-errors"></div></div></td></tr>
        
        <tr><td><label> Amount : </label></td>
        <td><input name="amount" class="form-control mid" value="<?php echo number_format($amount_to_be_paid,2); ?>" type="text"></td></tr>
        
      
        
       <tr><td> <label> Dated: </label></td>
        <td>
        <input name="dated" value="" class="form-control mid hasDatepicker " id="dated" type="input" required  data-error='Select Date'"></td></tr>
        
        <tr><td><label> <span class="label label-danger">*Bank Name:</span> </label></td>
        <td>
        <div class="input-group">
        <input name="bankname" value="" class="mid form-control" type="input" >
        <div class="help-block with-errors"></div>
        </td></tr>
        </div>
       <tr><td><label> City: </label></td>
        <td>
        <input name="bankcity" value="" class="form-control mid" type="input"><div class="help-block with-errors"></div></td></tr>
        
       <tr><td> <label> Branch: </label></td>
        <td>
        <input name="bankbranch" value="" class="form-control mid" type="input"><div class="help-block with-errors"></div></td></tr>
        
        <tr><td><label> Notes: </label></td>
        <td>
        <textarea rows="5" class="mid form-control" name="notes"></textarea></td></tr>
        
       
      <input name="totalprice" value="<?php echo $totalCost; ?>" type="hidden">
      
      <tr><td colspan="2"><input value="Save" class="button medium white text-right" type="submit"> </td>
	</tr>

                	</table>
                </div>
                </form>
        </div>
       
    </div>

   
</div>
