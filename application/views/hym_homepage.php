<div class="row">
    <div class="col-xs-8 col-md-8">
        <?php echo $this->session->flashdata('msg'); ?>
        <img src="/images/hym_2016.png" title="HYM 2016" alt="HYM 2016" class="img-responsive hym-responsive"/>
    </div>
    <div class="col-xs-4 col-md-4 ">
        <div class="panel panel-default homepage-loginblock">
            <div class="panel-heading">User Login</div>
            <?php
            if (!empty($errorMessage))
                echo "<div class='alert alert-warning' style='margin-bottom:0px;text-algin:center'>{$errorMessage}</div>";
            ?>
            <div class="panel-body">
                <form method="post" action="/hymindia/processform" id="loginform" class="form-horizontal">
                    <div class="input-group">

                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                        <input type="input" class="form-control" name="delegates_emailid" placeholder="email id"/>

                    </div>

                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>

                        <input type="password" class="form-control" name="delegates_password" placeholder="password"/>

                    </div>
                    <input type="submit" class="form-control btn btn-primary" name="delegate-password" value="Login"/>
                </form>
            </div>
            <div class="panel-footer">
                <a href="/delegate_registration">Register Now</a> | <a href="/reset_password">Reset Password</a>

            </div>
        </div>
        <div class="panel-default">
            Destination 2016 :  "The Garden City of India".
            Also known as Bengaluru it is the 3rd largest city and the 5th largest metropolitan area in India. Bangalore, located in southern India on the deccan plateau
            <a href="http://www.hymindia.org/" target="_blank">more...</a> 
        </div>
    </div>
</div>