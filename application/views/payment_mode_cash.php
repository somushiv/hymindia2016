<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
            <legend>Payment Mode - Cash
                <span class="payment-amount nav nav-pills pull-right packages-view-lnks label label-primary">
                    <?php echo getCurrencyFormat($total_amt, $country_code); ?>
                </span>
            </legend>
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("event_registration/cashmode", $attributes);
            ?>
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="persname" class="control-label">Person Name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="persname" name="persname" placeholder="Person Name" type="text" class="form-control"  value="<?php echo set_value('persname'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('persname'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="phone_no" class="control-label">Phone Number</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="phone_no" name="phone_no" placeholder="Mobile/Phone Number" type="text" class="form-control"  value="<?php echo set_value('phone_no'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('phone_no'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                        <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit" />
                        <a href="/event_registration" class="btn btn-danger" > Cancel </a>
                    </div>
                </div>
            </fieldset>

            <?php echo form_close(); ?>
        </div>
    </div>	<!-- row end -->
</div> <!-- container end -->