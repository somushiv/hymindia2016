<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_Transporation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('app_auth');
        $this->load->library('application_common_libs');
        $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }
    }

    public  function index(){
    	
    }
    
    public  function registration0(){
    	$this->load->helper('hymindia');
    	$this->load->helper("form");
    	$data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        $delegate_id=$data['loginuser'];
        $country_code = hlpcountry_mode($this->app_auth->appUserCountryCode());
        $partnerObject=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$delegate_id);
        
        //Build Partner
        $number_pickups='';
        $number_pickups.='<input type="checkbox" name="n_101"  checked /> Self&nbsp;&nbsp;';
        foreach($partnerObject->result() as $row){
        	
        	$number_pickups.='<input type="checkbox" name="n_'.$row->delagate_partner_rel.'"  checked /> '.getRelationships($row->delagate_partner_rel);
        }
        $data['number_pickups']=$number_pickups;
        $data['modes'] = getTransporationModes();
        $this->template->add_js('js/trasporation.js', "import", FALSE, TRUE);
        $this->template->write_view("content", "delegate_tranporation_view", $data);
        $this->template->render();
    }
   private function insert_trandata($delegate_id,$partner_check=0){
   	
   		
   	
   	  if ($partner_check==0){
   		$data=array(
   				'delegate_id'=>$delegate_id,
   				'relationship'=>101,
   				'transporation_stage'=>1
   			);
   			$this->db->insert('tbl_transporation',$data);
   			$data['transporation_stage']=2;   
   			$this->db->insert('tbl_transporation',$data);
   	
   	  }
   	
   		$partnerobject=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$delegate_id);
   		foreach($partnerobject->result() as $row){
   			$data=array(
   				'delegate_id'=>$delegate_id,
   				'relationship'=>$row->delagate_partner_rel,
   				'transporation_stage'=>1
   			);
   			$this->db->insert('tbl_transporation',$data);   
   			$data['transporation_stage']=2;   
   			$this->db->insert('tbl_transporation',$data);			
   		}
   		redirect("/delegate_transporation/registration");
   	   
   }
   
  public  function registration(){
    	$this->load->helper('hymindia');
    	$this->load->helper("form");
    	$data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        $delegate_id=$data['loginuser'];
        $country_code = hlpcountry_mode($this->app_auth->appUserCountryCode());
        $partnerObject=$this->db->query('select * from tbl_transporation where delegate_id='.$delegate_id.' order by transporation_stage, relationship desc');
        $countObject=$this->db->query('select *  from tbl_transporation where delegate_id='.$delegate_id); 
        $partnerobject=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$delegate_id);  		
   		if ($countObject->num_rows()==0) {
       		 $this->insert_trandata($delegate_id);
   		}
   		echo $countObject->num_rows();
   		if ((($partnerobject->num_rows()*2)+2)>$countObject->num_rows()){
   			
   			$this->insert_trandata($delegate_id,1);
   		}
        $displayTable='<table border="0" class="table">';
        $transporation_stage=0;
        $mode_text='';
        $mode_text1='';
        $idrefArray=array();
        foreach($partnerObject->result() as $row){
        	if ($transporation_stage!=$row->transporation_stage){
        		$transporation_stage=$row->transporation_stage;
        		if ($transporation_stage==1){
        			$displayTable.='<tr><td colspan="5" style="background-color:#F2F1F0"> :: Arriving Details</td></tr>';
        			$mode_text=" Arriving ";
        			$mode_text1=' Arriving From ';
        	   }
        		if ($transporation_stage==2){
        			$displayTable.='<tr><td colspan="5" style="background-color:#F2F1F0"> :: Departure Details</td></tr>';
        			$mode_text=" Departure ";
        			$mode_text1=' Depature To ';
        		}	
        		
        	}
        	
        		
        	
        	
        	$idrefArray[]=$row->transporation_id;
        	$displayTable.='<tr>';
        	$displayTable.='<td>'.getRelationships($row->relationship).'</td>';
        	$displayTable.='<td>'.getTransporationDropDown($row->transporation_mode,'mode_'.$row->transporation_id).'</td>';
        	$displayTable.='<td><input type="text" value="'.$row->transporation_datetime.'" class="datetimepicker" placeholder=" '.$mode_text.' Date " name="date_'.$row->transporation_id.'"/></td>';
        	$displayTable.='<td><input type="text" value="'.$row->arrival_departure_from.'" placeholder=" '.$mode_text1.' " name="ad_'.$row->transporation_id.'"/></td>';
        	$displayTable.='<td><input type="text" value="'.$row->refrence_number.'" placeholder=" Train/Airline Number " name="ref_'.$row->transporation_id.'"/></td>';
        	$displayTable.='</tr>';
        	
        	
        }
        $displayTable.='</table>';
        $displayTable.='<input name="referids" value="'.implode(",",$idrefArray).'" type="hidden"/>
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input type="hidden" name="step1" value="3" />
                    <input id="btn_add" type="submit" name="btn_add" type="submit" class="btn btn-primary" value="Submit selection" />                    
                </div>
            </div>
        
        ';
       
         $data['displayTable']=$displayTable;
       $this->template->add_css('js/jquery.datetimepicker.css', "import");
        $this->template->add_js('js/jquery.datetimepicker.js', "import", FALSE, TRUE);
        $this->template->add_js('js/trasporation1.js', "import", FALSE, TRUE);
        $this->template->write_view("content", "delegate_tranporation_view01", $data);
        $this->template->render();
    }
    public function index1() {
        $this->load->helper("form");
        $this->load->helper('hymindia');
        $this->load->library('form_validation');

        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();

        $data['modes'] = getTransporationModes();

        $this->template->add_css('css/bootstrap-datetimepicker.min.css');

        $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);

        $this->template->add_js('js/trasporation.js', "import", FALSE, TRUE);





        $this->form_validation->set_rules('delegates_departute_from', 'Departure From', 'trim|required');
        $this->form_validation->set_rules('delegate_tstage', 'PickUp/Drop', 'trim|required');
        $this->form_validation->set_rules('delegates_tdate', 'Date & Time', 'callback_custdate_check');
        $this->form_validation->set_rules('delegates_tmode', 'Select Mode', 'callback_mode_check');

        $country_code = $this->delegate_registration_model->getCountryCode($data['loginuser']);
        
        $data['trans_details'] = $this->delegate_registration_model->getTransportationBookedDetails($data['loginuser']);
        
        $data['dele_mode'] = 1;
        if ($country_code == 'IN') {
            $data['dele_mode'] = 0;
        }

        if ($this->form_validation->run() == FALSE) {

            $this->template->write_view("content", "delegate_tranporation_view", $data);
            $this->template->render();
        } else {

            // Read all inputs.
            $pickup_or_drop = $this->input->post('delegate_tstage');
            $tmode = $this->input->post('delegates_tmode');
            $datetime = $this->input->post('delegates_tdate');
            $from = $this->input->post('delegates_departute_from');
            $ref_no = $this->input->post('delegates_refnumber');
            $addl_req = $this->input->post('delegates_addreq');

            // Payment Data array.
            $data_arr = array(
                'transporation_mode' => $tmode,
                'transporation_stage' => $pickup_or_drop,
                'transporation_datetime' => $datetime,
                'arrival_departure_from' => $from,
                'delegate_id' => $data['loginuser'],
                'additional_requests' => $addl_req,
                'refrence_number' => $ref_no,
                'updated_at' => date("Y-m-d H:i:s")
            );

            $this->db->insert('tbl_transporation', $data_arr);  // Insert into tbl_payment_refernce Table.
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Registered !!!. </div>');

            redirect('delegate_transporation');
        }
    }

    public function custdate_check($date) {
        echo $date;

        if (trim($date) == '') {
            $this->form_validation->set_message('custdate_check', '<span class="text-danger"><small>Please select the date.</small></span>');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function mode_check($mode) {
        if ($mode == 0) {
            $this->form_validation->set_message('mode_check', '<span class="text-danger"><small>Please select proper option.</small></span>');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function update(){
    	//print_r($_POST);
    	$referids=explode(',',$_POST['referids']);
    	
    	foreach($referids as $value){
    		$data=array(
    		'transporation_mode'=>$_POST['mode_'.$value],
    			'transporation_datetime'=>$_POST['date_'.$value],
    			'arrival_departure_from'=>$_POST['ad_'.$value],
    		
    			'refrence_number'=>$_POST['ref_'.$value],
    			);
    			$this->db->where('transporation_id',$value);
    			$this->db->update('tbl_transporation',$data);		
    	}
    	redirect("/daytours_registration/registration");
    }
    public function update1(){
    	$this->load->helper('hymindia');
    	$attendees_object=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$this->app_auth->appUserid());
    	$total_number=$attendees_object->num_rows();
    	$getRelationships=getRelationships();
    	$setRelatinship=array();
    	foreach($getRelationships as $key=>$value){
    		$checkString='n_'.$key;
    		if (isset($_POST[$checkString]))
    			$setRelatinship[]=$key;
    	}
    	
    	
    	foreach($setRelatinship as $rel_val){
    	if (isset($_POST['delegate_pickup'])){
    		$dataArray=array(
    			'transporation_mode'=>$_POST['delegates_pickup_mode'],
    			'transporation_stage'=>1,
    			'transporation_datetime'=>$_POST['delegates_pickup_date'],
    			'arrival_departure_from'=>$_POST['delegates_coming_from'],
    			'additional_requests'=>$_POST['delegates_pickup_notes'],
    			'refrence_number'=>$_POST['delegates_pickup_refrence_number'],
    			'delegate_id'=>$this->app_auth->appUserid(),
    			'relationship'=>$rel_val,
    		);
    		$this->db->insert('tbl_transporation',$dataArray);
    	}
    	}
    	foreach($setRelatinship as $rel_val){
    	if (isset($_POST['delegate_drop'])){
    		$dataArray=array(
    			'transporation_mode'=>$_POST['delegates_departure_mode'],
    			'transporation_stage'=>2,
    			'transporation_datetime'=>$_POST['delegates_departure_date'],
    			'arrival_departure_from'=>$_POST['delegates_departure_place'],
    			'additional_requests'=>$_POST['delegates_departure_notes'],
    			'refrence_number'=>$_POST['delegates_departure_refrence_number'],
    			'delegate_id'=>$this->app_auth->appUserid(),
    			'relationship'=>$rel_val,
    		);
    		$this->db->insert('tbl_transporation',$dataArray);
    	}
    	}
    	  redirect("/daytours_registration/registration");
    }

}
