<div class="row ">

    <?php if (isset($profile)) echo $profile; ?>
    
    
   <?php 
   	if ($mailmode==0){
   ?>

    <!-- User Details -->
    <div class="col-xs-9 col-sm-9 pull-right">
   		 <?php echo pagenavigation(); ?>
   		
    <?php }?>
     <?php 
     $mailpatch='';
   	if ($mailmode==1){
   	$mailpatch=' style="background-color:#cccccc;padding:10px 5px" ';
   	?>
   	
   	<style>
   	table{width:800px}
   	table table{width:100%}
   	td,th{valign:top}
   		.table .table{
   			border:2px solid #cccccc !important;
   		}
   		thead{background-color:#cccccc;font-size:18px}
   		th{background-color:#F2F1F0;font-size:18px}
   		
   	</style>
   	<table cellpadding="2" cellspacing="2" width="60%">
   		<tr><th style="background-color:#000000;color:#ffffff;text-align:centers" colspan="2">Bank Details</th>
   		<tr><th>Name </th><td>AGM OF 41 CLUBS OF INDIA</td></tr>
   		<tr><th>Account Number</th><td> 50100099045978</td></tr>
   		<tr><th>SWIFT CODE</th><td> HDFCINBB</td></tr>
   		<tr><th>IFSC</th><td>HDFC0002011</td></tr>
   		<tr><th>BANK NAME</th><td>HDFC BANK,</td></tr>
   		<tr><th>BRANCH</th><td>KENGERI SATELLITE TOWN. </td></tr>
   		<tr><th>BRANCH ADDRESS</th><td>NO 1104, 1st Main Road Kengeri Satellite Town, Bangalore - 560060</td></tr>
   		
   	</table><br/><br/>
   		<?php
   	}
   ?>
        <div class="panel panel-default">
		
            <div class="table-responsive">
                <table class="table table-bordered" >
                	<tr>
                	<td>
                    <!-- Partner Table -->
                    <table class="table table-bordered table-hover">
                    <thead><tr class="row-header"> <td colspan="5"> <h5 <?php echo $mailpatch; ?>> Spouse/Partner </h5></td></tr></thead>
                    
						<tr>
                            <th>Sl.no</th>
                            <th>Name</th>
                            <th colspan="5">Relationship</th>
                        </tr>
                    
                    <tbody>
                        
                         
                        <?php if ($partner_details): ?>
                            <?php echo $partner_details; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">No Partners Registred</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
                    </td>
                    <td></td>
                    </tr>
                    <!-- End of Partner Table -->

                    <!-- Event Registration -->
                    <tr>
                    <td>
                    <table class="table table-bordered table-hover">
                    <thead><tr class="row-header"> <td colspan="5"> <h5 <?php echo $mailpatch; ?>> Event Registration </h5></td></tr></thead>
                     
                        <tr>
                            <th>Sl.no</th>
                            <th>Package Name</th>
                            <th>Num<br/>Attendees</th>
                             <th>Cost<br/>Split</th>
                            <th>Total<br/>Cost</th>
                           
                        </tr>
                     
                     <tbody>   
                        <?php if ($event_registration): ?>
                        <?php 
                        	echo $event_registration; 
                        ?>
                        
                         <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">Event Not Registred</td>
                            </tr>
                        <?php endif; ?>
                   
                  
                       
                    </tbody>
                    </table>
                     </td>
                    <td><?php echo number_format($event_registration_total); ?></td>
                    </tr>
                    <!-- End of Event Registration -->

                    <!-- Accommodation -->
                    <tr>
                    <td>
                    <table class="table table-bordered table-hover">
                    <thead><tr class="row-header"> <td colspan="6"> <h5 <?php echo $mailpatch; ?>> Accommodation </h5></td></tr></thead>
                     
                        <tr>
                            <th>Sl.no</th>
                            <th>Place Name</th>
                            <th>Room Type</th>
                            <th>Cost Per Day</th>
                            <th>Days</th>
                             <th>Total Cost</th>
                             
                        </tr>
                     
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if ($acc_details): ?>
                           	<?php echo $acc_details; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">No results found!!!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
                     </td>
                    <td><?php echo number_format($acc_cost_total); ?></td>
                    </tr>
                    <!-- End of Accommodation -->

                    <!-- Tours/Travel -->
                    <tr>
                    <td>
                    <table class="table table-bordered table-hover">
                   <thead> <tr class="row-header"> <td colspan="5"> <h5 <?php echo $mailpatch; ?>> Tours/Travel </h5></td></tr></thead>
                     
                        <tr>
                            <th>Sl.no</th>
                            <th>Place Name</th>
                            
                            <th>Type</th>
                            <th>Cost</th>
                        </tr>
                     
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if ($tour_details): ?>
                           	<?php echo $tour_details; ?>
                          
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">No results found!!!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
                     </td>
                    <td><?php echo number_format($tour_total_cost); ?></td>
                    </tr>
                    <!-- End of Tours/Travel -->

                    <!-- Day Tours/Travel -->
                    <tr>
                    <td>
                    <table class="table table-bordered table-hover">
                    <tr class="row-header"> <td colspan="5"> <h5 <?php echo $mailpatch; ?>> Day Tours/Travel </h5></td></tr>
                    <thead>
                        <tr>
                            <th>Sl.no</th>
                            <th>Place Name</th>
                            
                            <th>Relationship/Date</th>
                            <th>Cost</th> 
                        </tr>
                    </thead>
                    <tbody>
                         
                        <?php if ($day_trip): ?>
                           <?php echo $day_trip; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">No results found!!!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
                     </td>
                    <td><?php echo number_format($daytourTotalCost); ?></td>
                    </tr>
                    <!-- End of Day Tours/Travel -->

                    <!-- Day Transportation -->
                    <tr>
                    <td>
                    <table class="table table-bordered table-hover">
                    <thead><tr class="row-header"> <td colspan="2" > <h5 <?php echo $mailpatch; ?>> Transportation </h5></td></tr></thead>
                    
                       
                     
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if ($trans_details): ?>
                           <?php echo $trans_details; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="alert alert-warning text-center">No results found!!!</td>
                            </tr>
                        <?php endif; ?>

                        
                       
                    </tbody>
                    </table>
                    </td>
                    <td>
                    	<?php echo number_format($trans_totalcost,2); ?>
                    </td>
                    </tr>
                    <tr>
                    	<td align="right" ><strong>Total Amount: </strong></strong></td><td><?php echo number_format($finalTotal); ?></td>
                    </tr>
                    <?php if ($mailmode==0){?>
                    <tr>
                    	<td><a href="/paymentinfo/paymentinput" class="btn btn-primary">Pay Now</a></td>
                    </tr>
                    <?php }?>
                    <!-- End of Transportation -->
                </table>
            </div>
        </div>
    </div>

</div>
