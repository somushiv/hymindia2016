<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
	
    <form method="post" action="/delegate_transporation/update" id="loginform" class="form-horizontal">
        <div class="col-sm-offset-0 col-lg-9 col-sm-8">
         <?php echo pagenavigation(); ?>
        <div class="panel panel-default pwd-reset-block">
                <div class="panel-heading">Transportation <span class='add-text'></span>
                   

                </div>

                <div class="panel-body transporation-form">
            <?php echo $displayTable ?>
          
            </div>
            </div>
        </div>
    </form>
</div>

