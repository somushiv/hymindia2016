<style>
<!--
.table input{width:180px}
-->
</style>
<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
	
    <form method="post" action="/delegate_transporation/update" id="loginform" class="form-horizontal">
        <div class="col-sm-offset-0 col-lg-9 col-sm-9">
        
         <?php echo pagenavigation(); ?>
        <div class="panel panel-default pwd-reset-block">
       
                <div class="panel-heading">Transportation <div class='alert alert-info pull-right' style="padding:0px"><?php echo $picDropDisplay; ?></div>
                   

                </div>

                <div class="panel-body transporation-form">
            <?php echo $displayTable ?>
          
            </div>
            </div>
        </div>
    </form>
</div>

