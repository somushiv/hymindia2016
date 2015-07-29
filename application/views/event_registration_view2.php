<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
    <div class="col-xs-9 col-sm-9" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="main-title"> Options Included - <?php echo $stage_text; ?> </span>
                <span class="nav nav-pills pull-right packages-view-lnks">
                    <a class="first" href="#">View All</a>
                </span>
            </div>
           <style type="text/css">
.scroll-area {
	height: 400px;
	position: relative;
	overflow: auto;
}
</style>
             <form action="/event_registration/update_event_registration2" method="post" accept-charset="utf-8"> 
            <div class="table-responsive scroll-area"  data-spy="scroll" data-target="#myNavbar" data-offset="0">
                <table class="table table-bordered">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                           
                            <th>Cost</th>
                            <th>Attendees</th>
                            <th>Total<br/>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php echo $packageData; ?>

                    </tbody>
                    
                </table>
            </div>
			
            <div class="panel-body">
                <div class="pull-right">
                    <input type='hidden' name="total-sum" id="total-sum" value="0"/>
                    <input type='hidden' name="step1" value="2"/>
                    <input type='hidden' name="country_code" id="country_code" value="<?php echo $country_code; ?>"/>
                    <a href="/delegate_accommodation" class="btn btn-primary">Skip</a>
                    <button type="submit" id="submit-event-reg" class="btn btn-primary" >Register</button>
                </div>
            </div> 
            </form>
        </div>
    </div>
</div>