<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
            <legend>Payment Mode - <?php echo $payment_mode; ?> 
                <span class="payment-amount nav nav-pills pull-right packages-view-lnks label label-primary">
                    <?php echo getCurrencyFormat($total_amt, $country_code); ?>
                </span>
            </legend>
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("event_registration/othermode", $attributes);
            ?>
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="ref-id" class="control-label">Reference ID</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="ref-id" name="ref-id" placeholder="Reference ID" type="text" class="form-control"  value="<?php echo set_value('ref-id'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('ref-id'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="bankname" class="control-label">Bank Name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="bankname" name="bankname" placeholder="Bank Name" type="text" class="form-control"  value="<?php echo set_value('bankname'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('bankname'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="branchname" class="control-label">Branch Name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="branchname" name="branchname" placeholder="Branch Name" type="text" class="form-control"  value="<?php echo set_value('branchname'); ?>" />
                        <span class="text-danger"><small> <?php echo form_error('branchname'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="date" class="control-label">Date</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="datetimepicker" name="date" placeholder="yyyy/mm/dd" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" />
                        <span class="text-danger"><small><?php echo form_error('date'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-sm-4">
                        <label for="note" class="control-label">Note</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="note" name="note" placeholder="Note" type="text-area" class="form-control"  value="<?php echo set_value('note'); ?>" />
                        <span class="text-danger"><small> <?php echo form_error('note'); ?></small></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                        <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit" />
                        <a href="/event_registration"  class="btn btn-danger"> Cancel </a>
                    </div>
                </div>

            </fieldset>

            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>	<!-- row end -->
</div> <!-- container end -->

<script type="text/javascript">
    $('#sandbox-container .input-group.date').datepicker({
    });
</script>