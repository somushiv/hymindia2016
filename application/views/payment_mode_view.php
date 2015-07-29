<div class="col-sm-offset-4 col-lg-offset-4 col-lg-6 col-sm-6">
    <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading">Event Delegate Registration - Payment Mode.</div>
        <div class="panel-body">
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "paymentmodeform");
            echo form_open("event_registration", $attributes);
            ?>

            <div class="form-group">
                <div class="col-lg-4 col-sm-4">
                    <label for="payment-mode" class="control-label">Payment Mode</label>
                </div>

                <div class="col-lg-8 col-sm-8 custom-drop-down">
                    <?php echo form_dropdown("payment-mode", $payment_modes, 0, "", " class='form-control' "); ?>                            
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input type="hidden" name="step1" value="3" />
                    <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Next" />                    
                </div>
            </div>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>