<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
            <legend>Coming Soon</legend>
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("event_registration", $attributes);
            ?>
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-lg-4 col-sm-4">
                        <!-- <label for="title" class="control-label">Payment Method</label> -->
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                        <input type="hidden" name="step1" value="3" />
                        <input id="btn_next" type="submit" name="btn_next" type="submit" class="btn btn-primary" value="Next" />
                        <a href="/event_registration"  id="btn_cancel" name="btn_cancel" class="btn btn-danger"> Cancel </a>
                    </div>
                </div>
            </fieldset>
            
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>	<!-- row end -->
</div> <!-- container end -->