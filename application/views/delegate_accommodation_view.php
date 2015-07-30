<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
    <form method="post" action="/delegate_accommodation/update" id="loginform" class="form-horizontal">
        <div class="col-sm-offset-0 col-lg-9 col-sm-9">
         <?php echo pagenavigation(); ?>
            <div class="panel panel-default pwd-reset-block">
            <div class='alert alert-info'>
            Early check in and late check out will incur additional charges as well

            </div>
        <div class="panel-heading">Accomodation</div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_aplace" class="control-label">Places</label>
                        </div>

                        <div class="col-lg-7 col-sm-7 custom-drop-down">
                            <?php echo $accomodation_type_data; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_check_in" class="control-label">Check In</label>
                        </div>
                        <div class="col-lg-7 col-sm-7">
                            <?php echo $check_in_date_time; ?>
                            <span class="text-danger"><small><?php echo form_error('delegates_check_in'); ?></small></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_check_out" class="control-label">Check Out</label>
                        </div>
                        <div class="col-lg-7 col-sm-7">
                            <?php echo $check_out_date_time; ?>
                            <span class="text-danger"><small><?php echo form_error('delegates_check_out'); ?></small></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_addreq" class="control-label">Addl. Request</label>
                        </div>
                        <div class="col-lg-7 col-sm-7">
                            <textarea id="additional_requests" name="additional_requests" placeholder="Additional Request" class="form-control" >
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_addreq" class="control-label"></label>
                        </div>
                        <div class="col-lg-7 col-sm-7">
                        	 <a href="/delegate_tours" class="btn btn-primary">Skip</a>
                        	<input type="submit" class="btn btn-primary" value="submit selection"/>
                        </div>
                     </div>   

                    
                    
                </div>
            </div>
        </div>
    </form>
</div>

