<div class="col-sm-offset-4 col-lg-4 col-sm-4">
    <div class="panel panel-default pwd-reset-block">
        <div class="panel-heading text-center">Reset Your Password.</div>
        <div class="panel-body">
            <form method="post" action="/reset_password" id="loginform" class="form-horizontal">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                    <input type="input" class="form-control" id="delegates_emailid" name="delegates_emailid" placeholder="Enter your Email-ID" value="<?php echo set_value('delegates_emailid'); ?>" />                    
                </div>
                <span class="text-danger text-center"><small><?php echo form_error('delegates_emailid'); ?></small></span>
                <input type="submit" class="form-control btn btn-primary" name="delegate-password" value="Reset"/>
            </form>
        </div>
    </div>
</div>


