<div class="row">
    <?php if (isset($profile)) echo $profile; ?>

    <form method="post" action="/delegate_transporation/update" id="loginform" class="form-horizontal">
        <div class="col-sm-offset-1 col-lg-6 col-sm-6">
        
            <div class="panel panel-default pwd-reset-block">
                <div class="panel-heading">Transportation <span class='add-text'></span>
                   

                </div>

                <div class="panel-body transporation-form">
                	<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">Pick up for</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <?php echo $number_pickups; ?>                    
                        </div>
                    </div>
                
                   
                   <div class="form-group">
                        <div class="col-lg-5 col-sm-5">
					<label class="radio-inline">
                                  I need to picked up  
                    </label>
                    </div>
                    	<div class="col-lg-7 col-sm-7 custom-drop-down">
                            <input type="checkbox" name="delegate_pickup" id="delegate_pickup" value="1">                        
                        </div>
                    </div>
                   
                   
					<div class="container1 pickupinfo">
						<!--  Coming in  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am coming in </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <?php echo form_dropdown("delegates_pickup_mode", $modes, 0, "", " class='widthfull form-control' "); ?>                        
                        </div>
                    </div>
						<!--  Arriving on  -->
					<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am coming on </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_pickup_date" name="delegates_pickup_date" placeholder="Enter Date mm/dd/yyyy" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    	<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am coming from </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_coming_from" name="delegates_coming_from" placeholder="Place Name" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    <!--  Arriving on  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label" id="picup_refrence_label">Refrence No</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_pickup_refrence_number" name="delegates_pickup_refrence_number" placeholder="details" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    <!--  Notes on  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label" id="picup_refrence_label">Any  Request?</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <textarea  id="delegates_pickup_notes" name="delegates_pickup_notes" placeholder=""  class="form-control" />  </textarea>                     
                        </div>
                    </div>
					</div>
                   
					<!--  Dropping ----------------------------------------------------------- -->
					<div class="form-group">
                        <div class="col-lg-5 col-sm-5">
					<label class="radio-inline">
                                 I need to be dropped 
                    </label>
                    </div>
                    	<div class="col-lg-7 col-sm-7 custom-drop-down">
                            <input type="checkbox" name="delegate_drop" id="delegate_drop" value="1">                        
                        </div>
                    </div>
                    <div class="container1 dropinfo">
						<!--  Coming in  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am leaving on </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <?php echo form_dropdown("delegates_departure_mode", $modes, 0, "", " class='widthfull form-control' "); ?>                        
                        </div>
                    </div>
						<!--  Arriving on  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am leaving in </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_departure_date" name="delegates_departure_date" placeholder="Enter Date mm/dd/yyyy" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label">I am leaving to </label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_departure_place" name="delegates_departure_place" placeholder="place name" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    
                    <!--  Arriving on  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label" id="departure_refrence_label">Refrence No</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <input  id="delegates_departure_refrence_number" name="delegates_departure_refrence_number" placeholder="details" type="text" class="form-control" value=""/>                       
                        </div>
                    </div>
                    <!--  Notes on  -->
						<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="delegates_tmode" class="control-label" id="picup_refrence_label">Any  Request?</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <textarea  id="delegates_departure_notes" name="delegates_departure_notes" placeholder=""  class="form-control" />  </textarea>                     
                        </div>
                    </div>
					</div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8">
                           		<a href="/dashboard" class="btn btn-primary">Skip</a>
                                <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit selection" />
                           
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('msg'); ?>

                </div>

            </div>
        </div>
    </form>
</div>

