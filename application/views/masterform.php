<?php
if (isset($formopen)) {
    ?>
    <form method="post" action="<?php echo $formopen['formaction'] ?>" id="hym-form validation-form"  
          class=" <?php echo $formopen['formclass']; ?> "  enctype="multipart/form-data">
              <?php
          } else {
              ?>
        <div class="alert alert-danger" role="alert"># Form Open is not Set</div>		
        <?php
    }
    ?>
    <div class="panel panel-default">
        <?php if (isset($formtitle)) { ?>
            <div class="panel-heading">
                <?php echo $formtitle; ?>
            </div>
        <?php } ?>
        <div class="panel-body">
            <?php
            if (isset($formcontent)) {
                echo $formcontent;
            } else {
                ?>
                <div class="alert alert-danger" role="alert"># Form Content is not Set</div>		
                <?php
            }
            ?>
        </div>


        <?php if (isset($formfooter)) { ?>
            <div class="panel-footer">
                <?php echo $formfooter; ?>
            </div>
        <?php } ?>
    </div>
</form>