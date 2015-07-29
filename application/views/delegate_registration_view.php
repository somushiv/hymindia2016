<div class="col-sm-offset-2 col-lg-8 col-sm-8">
    <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading">Delegates Registration.</div>
        <div class="panel-body">

            <form method="post" action="/delegate_registration" id="loginform" class="form-horizontal">
                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_title" class="control-label">Title</label>
                    </div>

                    <div class="col-lg-8 col-sm-8 custom-drop-down">
                        <?php echo form_dropdown("delegates_title", $titles, 0, "", " class='widthfull' "); ?>                        
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_firstname" class="control-label">First Name<span class="text-danger">&nbsp;*</span></label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_firstname" name="delegates_firstname" placeholder="First Name" type="text" class="form-control"  value="<?php echo set_value('delegates_firstname'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_firstname'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_surname" class="control-label">Surname</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_surname" name="delegates_surname" placeholder="Surame" type="text" class="form-control"  value="<?php echo set_value('delegates_surname'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_surname'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_clubnumber" class="control-label">Club Number</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_clubnumber" name="delegates_clubnumber" placeholder="Club Number" type="text" class="form-control"  value="<?php echo set_value('delegates_clubnumber'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_clubnumber'); ?></small></span>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_clubnumber" class="control-label">Delegate / Post held</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_post" name="delegates_post" placeholder="Delegate / Post held" type="text" class="form-control"  value="<?php echo set_value('delegates_post'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_clubnumber'); ?></small></span>
                    </div>
                </div>
               

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_emailid" class="control-label">Email ID<span class="text-danger">&nbsp;*</span></label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_emailid" name="delegates_emailid" placeholder="Email ID" type="text" class="form-control"  value="<?php echo set_value('delegates_emailid'); ?>" />
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_phone" class="control-label">Phone Number</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_phone" name="delegates_phone" placeholder="Phone Number" type="text" class="form-control"  value="<?php echo set_value('delegates_phone'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_phone'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_mobile" class="control-label">Mobile Number</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_mobile" name="delegates_mobile" placeholder="Mobile Number" type="text" class="form-control"  value="<?php echo set_value('delegates_mobile'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_mobile'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_address1" class="control-label">Street Name</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_address1" name="delegates_address1" placeholder="Street Name" type="text" class="form-control"  value="<?php echo set_value('delegates_address1'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_address1'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_address2" class="control-label">Address</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_address2" name="delegates_address2" placeholder="Address" type="text" class="form-control"  value="<?php echo set_value('delegates_address2'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_address2'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_city" class="control-label">City/Town</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_city" name="delegates_city" placeholder="City/Town" type="text" class="form-control"  value="<?php echo set_value('delegates_city'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_city'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_postalcode" class="control-label">Postal Code</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_postalcode" name="delegates_postalcode" placeholder="Postal Code" type="text" class="form-control"  value="<?php echo set_value('delegates_postalcode'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('delegates_postalcode'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_country" class="control-label">Country <span class="text-danger">&nbsp;*</span></label>
                    </div>

                    <div class="col-lg-8 col-sm-8 custom-drop-down">
                        <?php echo form_dropdown("delegates_country", $country_array, $country_code, "", " class='widthfull form-control' "); ?>                            
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_food_prefrence" class="control-label">Food Preference</label>
                    </div>

                    <div class="col-lg-8 col-sm-8 custom-drop-down">
                        <?php echo form_dropdown("delegates_food_prefrence", getFoodPref(), 1, "", " class='widthfull form-control' "); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3 col-sm-3">
                        <label for="delegates_allergies" class="control-label">Special Requirements if any.</label>
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <input id="delegates_allergies" name="delegates_allergies"  type="text" class="form-control"  value="<?php echo set_value('delegates_allergies'); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-lg-8 col-sm-8">
                        <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit" />                            
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>

