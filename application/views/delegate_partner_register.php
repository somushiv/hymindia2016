<div class="row">
    <?php if (isset($profile)) echo $profile; ?>

    <div class="col-sm-offset-1 col-lg-6 col-sm-6">
        <div class="panel panel-default pwd-reset-block">
            <div class="panel-heading">Register Your Partner.</div>
            <div class="panel-body">
                <form method="post" action="/delegate_partner/register" id="loginform" class="form-horizontal">
                
                	<div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-name" class="control-label">Title</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            
			<select name="partner_title" id="delegates_title">
			<option value="0" selected="selected">-- Select --</option>
			<?php 
				$arraytitle=array('Mr','Mrs','Ms','Dr','Prof');
				$option='';
				foreach($arraytitle as $value){
					$selected='';
					if ($fieldRow->partner_title==$value)
						$selected=' selected ';
					$option.='<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
				}
				echo $option;
			?>


		</select>

		
                            <span class="text-danger"><small><?php echo form_error('part-name'); ?></small></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-name" class="control-label">First Name</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <input id="part-name" name="part-name" placeholder="Partner Name" type="text" class="form-control"  value="<?php echo $fieldRow->delegate_partner_name; ?>" />
                            <span class="text-danger"><small><?php echo form_error('part-name'); ?></small></span>
                        </div>
                    </div>
					   <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-name" class="control-label">Surname</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <input id="part-name" name="sur_name" placeholder="Sur Name" type="text" class="form-control"  value="<?php echo $fieldRow->sur_name; ?>" />
                            <span class="text-danger"><small><?php echo form_error('part-name'); ?></small></span>
                        </div>
                    </div>
					   <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-name" class="control-label">Club Number</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <input id="partners_clubnumber" name="partners_clubnumber" placeholder="Club Number" class="form-control" value="<?php echo $fieldRow->partners_clubnumber; ?>" type="text">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-name" class="control-label">Delegate/Post Held</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <input id="partners_post_held" name="partners_post_held" placeholder="Delegate/Post Held" class="form-control" value="<?php echo $fieldRow->partners_post_held; ?>" type="text">
                        </div>
                    </div>   
                   
                    
                    
                    
                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-relation" class="control-label">Relationship</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <?php echo form_dropdown("part-relation", $rels, 0, "", " class='form-control' "); ?>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-food-pref" class="control-label">Food Preference</label>
                        </div>

                        <div class="col-lg-8 col-sm-8 custom-drop-down">
                            <?php echo form_dropdown("part-food-pref", $food_pref, $fieldRow->delegate_partner_food_pref, "", " class='form-control' "); ?>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 col-sm-4">
                            <label for="part-about" class="control-label">Notes</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <textarea id="part-about" name="part-about" placeholder="say something ..." 
                            	 class="form-control"><?php echo $fieldRow->delagate_partner_about; ?></textarea>
                            <span class="text-danger"><small><?php echo form_error('part-about'); ?></small></span>
                        </div>
                    </div>
                    <?php if ($dele_mode): ?>
                        <div class="form-group">
                            <div class="col-lg-4 col-sm-4">
                                <label for="part-passport" class="control-label">Passport No.</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="part-passport" name="part-passport" placeholder="Passport Number" type="text-area" class="form-control"  value="<?php echo $fieldRow->delegate_partner_passport; ?>" />
                                <span class="text-danger"><small> <?php echo form_error('part-passport'); ?></small></span>
                            </div>
                        </div>
                    <?php endif; ?>
					<input id="delegate_partner_id" type="hidden" name="delegate_partner_id" value="<?php echo $fieldRow->delegate_partner_id;?>" />   
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                        	<a href="/event_registration/registration_form" class="btn btn-primary">Skip</a>
                            <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit" />                           
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


