<div class="container">

      <div class="row">
<div class="span12">
    <div class="widget stacked">
        <div class="widget-header">
            <i class="icon-check"></i>
            <h3>
                <?php
                    if (isset($formheader)){
                        echo $formheader;
                    }else{
                        echo "Form Header is not Set!!!";
                    }
                ?>
            </h3>
        </div>
        <!-- Widget Content -->
        <div class="widget-content">
            <?php
                    if (isset($formcontent)){
                        echo $formcontent;
                    }else{
                        echo "Form Content is not Set!!!";
                    }
                ?>
        </div>
    </div>
</div>
</div>
</div>
