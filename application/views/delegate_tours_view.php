<div class="row">
    <?php if (isset($profile)) echo $profile; ?>
    <form method="post" action="/delegate_tours/process_form" id="loginform" class="form-horizontal">
        <div class=" col-lg-9 col-sm-9">
         <?php echo pagenavigation(); ?>
            <div class="panel panel-default pwd-reset-block">
                <div class="panel-heading">Tours
                   

                </div>

                <div class="panel-body">

                    <div class="form-group">
                        

                        <div >
                            <?php echo $tour_type_data; ?>
                            <span class="text-danger"><small class="tour-places-error"></small></span>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8">
                            <a href="/delegate_transporation/registration" class="btn btn-primary">Skip</a> 
                            <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary tour-button" value="Submit selection" />
                            
                        </div>
                    </div>

                    <?php echo $this->session->flashdata('msg'); ?>
                </div>

            </div>
        </div>
    </form>
</div>

 <!-- Modal HTML -->
   <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn btn-default" data-dismiss="modal" aria-hidden="true">&times;</button>
        
      </div>
      <div class="modal-body">
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
