<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
    <div class="col-xs-9 col-sm-9" >
     <?php echo pagenavigation(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="main-title"> Day Tour Registration </span>
               
            </div>
          
             <form action="/daytours_registration/update_daytour" method="post" accept-charset="utf-8"> 
            <div class="table-responsive scroll-area"  data-spy="scroll" data-target="#myNavbar" data-offset="0">
                <table class="table table-bordered">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Cost </th>
                            <th>Attendees</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                   	<?php echo $daytourData; ?>

					<tr>
						<td colspan="2"></td>
						<td><span id="total-sum1"></span></span></td>
						<td></td>
					</tr>
                    </tbody>
                    
                </table>
            </div>
			 
            <div class="panel-body">
                <div class="pull-right">
                    
                    <button type="submit" id="submit-event-reg" class="btn btn-primary" >Register</button>
                </div>
            </div> 
            </form>
        </div>
    </div>
</div>