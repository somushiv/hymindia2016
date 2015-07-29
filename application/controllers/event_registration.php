<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('app_auth');
         
        $this->load->library('application_common_libs');

        
        $this->load->library('session');
        $this->load->helper('hymindia');


        $this->load->database();
        $this->load->model('delegate_registration_model');

    $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }

        $this->template->add_css('css/bootstrap-datetimepicker.min.css');
        $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
//        $this->template->add_css('css/bootstrap-datetimepicker.min.css');
  //      $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
        $this->template->add_js('js/trasporation.js', "import", FALSE, TRUE);
    }
	public function index(){
		
	}
	public function  list_event_register(){
		$user_id = $this->app_auth->appUserid();
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
		//Validate Registration
		$delegateObject=$this->application_common_libs->delegate_event_registration_data($this->app_auth->appUserid());
		if (empty($delegateObject)){
			$this->registration_form();
		}else{
			$this->template->write_view("content","template_grid",$data);
			$this->template->render();
		}
	}
	public function registration_form(){
		    // Get logged in user ID.
		$this->load->helper('form');
        $user_id = $this->app_auth->appUserid();
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        if ($this->app_auth->appUserCountryCode()!="IN"){
        	$this->registration_form2();
        }
		$delegates_mode = 2;
        if ($data['country_code'] == 'IN') {
            $delegates_mode = 1;
        }
        $usermode_manage=0;
        $queryObject=$this->db->query('select * from tbl_delegates_event_registration
			where delegate_id='.$user_id);
       	if ($queryObject->num_rows()>0)
       		$usermode_manage=1;
        
        $today_date = date("Y-m-d");
        // Get Reg Stage Text.
        $reg_stage_text = $this->delegate_registration_model->getRegistrationStage($today_date);
        foreach ($reg_stage_text as $item) {
            $data['stage_text'] = isset($item->registration_stage_text) ? $item->registration_stage_text : NULL;
            $pack_stage_id = isset($item->registration_stage_id) ? $item->registration_stage_id : NULL;
        }
		$package_details=$this->delegate_registration_model->getPackageDetails($pack_stage_id, $delegates_mode);
		$packageData='';
		$counter=1;
        foreach ($package_details as $item){
        	if ($item->visual_index==8)
        		$packageData.="<tr><td></td><td colspan='4'><b>Single Event options</b> </td></tr>";
        	$packageData.="<tr>";
        	$packageData.="<td>{$counter}</td>";
        	$eventItems="<div id='callout-btndropdown-dependency'>
                                        <h4>{$item->packages_title}</h4>
                                        <p class='bs-callout bs-callout-danger'>
        									{$item->packages_description}
                                        </p>
                                    </div>";
        	$packageData.="<td>{$eventItems}</td>";
        	
        	//17th April Package Patch
        	$countrycost='';$package_patch='';
        	if ($item->packages_cost_d==0){
        			$item->packages_cost_d=$item->packages_cost_s * 2;
        	}
        	$countrycost=number_format($item->packages_cost_s,2).' (S) <br/>'.number_format($item->packages_cost_d,2).' (C) ';
        	$packageData.="<td class='text-right'>{$countrycost}</td>";
        	$peopleself="<ul class='list-unstyled'>";
        	$costdisplay='';
        	/*$peopleself.="<li><input type='checkbox' name='ep-{$item->packages_details_id}' class='attendees' eventcost='{$item->packages_cost}'
        				package_details_id='{$item->packages_details_id}' relitionship_id='' /> Self</li>";*/
        	//$queryObject=$this->db->query("select * from tbl_delegate_partner where delegate_id={$user_id}");
        	
        	//foreach ($queryObject->result() as $row){
        		//$partnerText=getRelationships($row->delagate_partner_rel);
        	
        		$costdisplayString='';
        		$dropdown="<select name='ep-{$item->packages_details_id}'
        		package_details_id='{$item->packages_details_id}' 
        		class='attendees' eventcost_s='{$item->packages_cost_s}' eventcost_d='{$item->packages_cost_d}'
        		>";
        		$coupleArray=array('Select','Self','Partner');
        		for($j=0;$j<3;$j++){
        		$fieldRow=$this->updateobject($item->packages_details_id);
        		$select='';
        		if (!empty($fieldRow->package_id)){
        				
        				if (($fieldRow->package_id==$item->packages_details_id)&&($fieldRow->delegate_numbers==$j)){
        					if ($fieldRow->delegate_numbers>0){
        					if ($j==1){
        						$costdisplayString=$item->packages_cost_s;
        					}else{
        						$costdisplayString=$item->packages_cost_d;
        					}
        					$costdisplayString=number_format($costdisplayString,2);
        					}
        					$select=' selected ';
        				}
        		}
        			$dropdown.="<option value='{$j}' {$select}>{$coupleArray[$j]}</option>";
        			
        		}
        		$dropdown.="</select>";
        		$costdisplay.="<div class='dep-{$item->packages_details_id}-'>{$costdisplayString}</div>";
        		$peopleself.="<li>{$dropdown}</li>";
        		//$costdisplay.="<div class='dep-{$item->packages_details_id}-{$row->delegate_partner_id}'></div>";
        	//}
        	$peopleself.="</ul>";
        	
        	$packageData.="<td>{$peopleself}</td>";
        	$packageData.="<td class='text-right'>{$costdisplay}</td>";
        	$packageData.="</tr>";
        	$counter++;
                               
        }
         $data['packageData']=$packageData.'<input type="hidden" name="usermode_manage" value="'.$usermode_manage.'"/>';
        $data['no_partners'] = $this->delegate_registration_model->getPartnerCountr($user_id);
        
        $this->template->add_js('js/event_registration.js', "import", FALSE, TRUE);
                $data['package_details'] = $this->delegate_registration_model->getPackageDetails($pack_stage_id, $delegates_mode);
                $this->template->add_css('/css/font-awesome.min.css');
                $this->template->write_view("content", "event_registration_view", $data);
                $this->template->render();
		
	}
	
	function updateobject($package_id=0){
		$queryObject=$this->db->query('select * from tbl_delegates_event_registration
			where delegate_id='.$this->app_auth->appUserid().'
			and package_id='.$package_id);
		if ($queryObject->num_rows()==0){
			$fieldRowA = $this->db->list_fields('daytour_registration');
        	$fieldRow=array();
        	foreach($fieldRowA as $value){
        		$fieldRow[$value]='';
        	}
        	$fieldRow=(object)$fieldRow;
		}else{
			$fieldRow=$queryObject->row();
		}
		return $fieldRow;
	}
	
	function update_event_registration(){
		
		$data=array();
		$data['delegate_id'] = $this->app_auth->appUserid();
		foreach($_POST as $postKey=>$postvalue){
			if (substr($postKey,0,2)=='ep'){
				$tmpArray=explode("-",$postKey);
				
				$data['package_id'] =$tmpArray[1];
				$data['delegate_numbers'] =$postvalue;
				if ($_POST['usermode_manage']==0){
				$this->db->insert('tbl_delegates_event_registration',$data);
				redirect('/delegate_accommodation');
				}else{
					$wharearray=array(
						'delegate_id'=>$data['delegate_id'],
						'package_id'=>$data['package_id']
					);
					$this->db->update('tbl_delegates_event_registration',$data,$wharearray);
					redirect('/dashboard');
				}
			}
			
		}
		
		
	}
	/*
	 * **************************** Out Side India code *****************************
	 */
public function registration_form2(){
		    // Get logged in user ID.
		$this->load->helper('form');
        $user_id = $this->app_auth->appUserid();
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        if ($this->app_auth->appUserCountryCode()=="IN"){
        	$this->registration_form();
        }
		$delegates_mode = 2;
        if ($data['country_code'] == 'IN') {
            $delegates_mode = 1;
        }
        $usermode_manage=0;
        $queryObject=$this->db->query('select * from tbl_delegates_event_registration
			where delegate_id='.$user_id);
       	if ($queryObject->num_rows()>0)
       		$usermode_manage=1;
        $today_date = date("Y-m-d");
        // Get Reg Stage Text.
        $reg_stage_text = $this->delegate_registration_model->getRegistrationStage($today_date);
        foreach ($reg_stage_text as $item) {
            $data['stage_text'] = isset($item->registration_stage_text) ? $item->registration_stage_text : NULL;
            $pack_stage_id = isset($item->registration_stage_id) ? $item->registration_stage_id : NULL;
        }
		$package_details=$this->delegate_registration_model->getPackageDetails($pack_stage_id, $delegates_mode);
		$packageData='';
		$counter=1;
		$attedeeArray=array(0=>'Select',1=>'Single',2=>'Couple');
        foreach ($package_details as $item){
        	if ($item->visual_index==5)
        		$packageData.="<tr><td></td><td colspan='4'><b>Additional options</b> </td></tr>";
        	
        	$packageData.="<tr>";
        	$packageData.="<td>{$counter}</td>";
        	$eventItems="<div id='callout-btndropdown-dependency'>
                                        <h4>{$item->packages_title}</h4>
                                        <p class='bs-callout bs-callout-danger'>
        									{$item->packages_description}
                                        </p>
                                    </div>";
        	$packageData.="<td>{$eventItems}</td>";
        	
        	
        		$dropdown="<select name='ep-{$item->packages_details_id}'
        		package_details_id='{$item->packages_details_id}' 
        		class='attendees2' eventcost_s='{$item->packages_cost_s}' eventcost_d='{$item->packages_cost_d}'
        		>";
        		foreach($attedeeArray as $key=>$value){
        			$fieldRow=$this->updateobject($item->packages_details_id);
        		$select='';
        		if (!empty($fieldRow->package_id)){
        				
        				if (($fieldRow->package_id==$item->packages_details_id)&&($fieldRow->delegate_numbers==$key)){
        					if ($fieldRow->delegate_numbers>0){
        					if ($key==1){
        						$costdisplayString=$item->packages_cost_s;
        					}else{
        						$costdisplayString=$item->packages_cost_d;
        					}
        					$costdisplayString=number_format($costdisplayString,2);
        					}else{
        						$costdisplayString='';
        					}
        					$select=' selected ';
        				}
        		}
        			$dropdown.="<option value='{$key}' {$select}>{$value}</option>";
        		}
        		$dropdown.="</select>";
        	
        	//$countrycost="<input name='delegates_refer' type='radio' value='".$item->packages_details_id."' />&nbsp;".number_format($item->packages_cost_s,2);
        	$costPackage=number_format($item->packages_cost_s,2);
        	$packageData.="<td class='text-right'>{$costPackage}</td>";	
        	$packageData.="<td class='text-right'>{$dropdown}</td>";
        	$costdisplay="<div class='dep-{$item->packages_details_id}-'>{$costdisplayString}</div>";
        	$packageData.="<td class='text-right'>{$costdisplay}</td>";
        	
        	//$packageData.="<td>{$peopleself}</td>";
        	//$packageData.="<td class='text-right'>{$costdisplay}</td>";
        	$packageData.="</tr>";
        	$counter++;
                               
        }
         $data['packageData']=$packageData.'<input type="hidden" name="usermode_manage" value="'.$usermode_manage.'"/>';
        $data['no_partners'] = $this->delegate_registration_model->getPartnerCountr($user_id);
        
        $this->template->add_js('js/event_registration.js', "import", FALSE, TRUE);
                $data['package_details'] = $this->delegate_registration_model->getPackageDetails($pack_stage_id, $delegates_mode);
                $this->template->add_css('/css/font-awesome.min.css');
                $this->template->write_view("content", "event_registration_view2", $data);
                $this->template->render();
		
	}
	function update_event_registration2(){
		
		$data=array();
		$data['delegate_id'] = $this->app_auth->appUserid();
		foreach($_POST as $postKey=>$postvalue){
			if (substr($postKey,0,2)=='ep'){
				$tmpArray=explode("-",$postKey);
				
				$data['package_id'] =$tmpArray[1];
				$data['delegate_numbers'] =$postvalue;
				
			if ($_POST['usermode_manage']==0){
				$this->db->insert('tbl_delegates_event_registration',$data);
				redirect('/delegate_accommodation');
				}else{
					$wharearray=array(
						'delegate_id'=>$data['delegate_id'],
						'package_id'=>$data['package_id']
					);
					$this->db->update('tbl_delegates_event_registration',$data,$wharearray);
					redirect('/dashboard');
				}
			}
			
		}
		
	}
	/*
	 * Sadanand Code
	 */
    public function index1() {
    	
        // Get logged in user ID.
        $user_id = $this->app_auth->appUserid();
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        
        $delegates_mode = 2;
        if ($data['country_code'] == 'IN') {
            $delegates_mode = 1;
        }

        $today_date = date("Y-m-d");
        // Get Reg Stage Text.
        $reg_stage_text = $this->delegate_registration_model->getRegistrationStage($today_date);
        foreach ($reg_stage_text as $item) {
            $data['stage_text'] = isset($item->registration_stage_text) ? $item->registration_stage_text : NULL;
            $pack_stage_id = isset($item->registration_stage_id) ? $item->registration_stage_id : NULL;
        }

        $data['no_partners'] = $this->delegate_registration_model->getPartnerCountr($user_id);

        // Multisptep Form.
        $step = 1;
        if ($this->input->post('step1')) {
            $step = $this->input->post('step1');
        }

        switch ($step) {
            case 1:
                $this->unset_session_vars();
                // Get package_details.
                // $params :  package id and country_mode;
                $data['loginuser'] = $this->app_auth->appUserid();

                $this->template->add_js('js/event_registration.js', "import", FALSE, TRUE);
                $data['package_details'] = $this->delegate_registration_model->getPackageDetails($pack_stage_id, $delegates_mode);
                $this->template->add_css('/css/font-awesome.min.css');
                $this->template->write_view("content", "event_registration_view", $data);
                $this->template->render();
                break;
            case 2:
                $data['loginuser'] = $this->app_auth->appUserid();


                $real_ids = count($this->input->post()) - 2;
                foreach ($this->input->post() as $key => $val) {
                    if (!$real_ids)
                        break;
                    $package_ids[] = $key;
                    $real_ids --;
                }
                $pack_details_string = implode("|", $package_ids);
                $total_cost = $this->input->post('total-sum');
                // Put required things in session.
                $this->session->set_userdata('package_details_id_str', $pack_details_string);
                $this->session->set_userdata('package_stage_id', $pack_stage_id);
                $this->session->set_userdata('total_cost', $total_cost);

                $data['payment_modes'] = getPaymentModes();


                $this->template->write_view("content", "payment_mode_view", $data);
                $this->template->render();
                break;

            case 3:
                $mode_id = $this->input->post('payment-mode');

                if ($mode_id == 0) { // Online
                    $this->payment_mode_online();
                } else if ($mode_id == 5) { // Cash
                    $this->payment_mode_cash($mode_id);
                } else { // Cheque,DD, NEFT etc..
                    $this->payment_mode_others($mode_id);
                }

                break;
        }
    }

    public function payment_mode_cash($mode_id) {
        $this->session->set_userdata('mode_id', $mode_id);
        $data['loginuser'] = $this->app_auth->appUserid();
        $data['country_code'] = $this->app_auth->appUserCountryCode();

        $total_cost = $this->session->userdata('total_cost');
        $data['total_amt'] = isset($total_cost) ? $total_cost : 0;

        $this->template->write_view("content", "payment_mode_cash", $data);
        $this->template->render();
    }

    public function payment_mode_others($mode_id) {
        $this->session->set_userdata('mode_id', $mode_id);

        $total_cost = $this->session->userdata('total_cost');
        $data['total_amt'] = isset($total_cost) ? $total_cost : 0;

        $data['loginuser'] = $this->app_auth->appUserid();
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        $data['payment_mode'] = getPaymentModes($mode_id);

        $this->template->write_view("content", "payment_mode_others", $data);
        $this->template->render();
    }

    public function payment_mode_online() {

        $this->template->write_view("content", "payment_mode_online");
        $this->template->render();
    }

    public function othermode() {
        $this->form_validation->set_rules('ref-id', 'Reference ID', 'trim|required');
        $this->form_validation->set_rules('bankname', 'Bank Name', 'trim|required');
        $this->form_validation->set_rules('branchname', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['loginuser'] = $this->app_auth->appUserid();
            $data['country_code'] = $this->app_auth->appUserCountryCode();
            $total_cost = $this->session->userdata('total_cost');
            $data['total_amt'] = isset($total_cost) ? $total_cost : 0;

            $mode_id = $this->session->userdata('mode_id');
            $data['payment_mode'] = getPaymentModes($mode_id);

            $this->template->write_view("content", "payment_mode_others", $data);
            $this->template->render();
        } else {
            // Read from Input.
            $ref_id = $this->input->post('ref-id');
            $bankname = $this->input->post('bankname');
            $branchname = $this->input->post('branchname');
            $date = $this->input->post('date');
            $note = $this->input->post('note');
            $note = isset($note) ? $note : NULL;

            // Session data.
            $mode_id = $this->session->userdata('mode_id');
            $total_cost = $this->session->userdata('total_cost');
            $payment_categary = 0;

            // Get logged in user ID.
            $user_id = $this->app_auth->appUserid();
            $data['country_code'] = $this->app_auth->appUserCountryCode();

            // Json String 
            $payment_json = '{"payment_details":[
                    {"bankName":' . $bankname . ', "branchName": ' . $branchname . '},
                    {"date":' . $date . ', "note":" . ' . $note . '"}
                ]}';

            // Payment Data array.
            $data_arr = array(
                'delegate_id' => $user_id,
                'payment_mode' => $mode_id,
                'total_cost' => $total_cost,
                'payment_reference_id' => $ref_id,
                'payment_details' => $payment_json,
                'payment_categary' => $payment_categary,
                'created_at' => date("Y-m-d H:i:s")
            );

            $this->delegate_event_registration_store();
            $this->db->insert('tbl_payment_refrence', $data_arr);  // Insert into tbl_payment_refernce Table.
            $this->unset_session_vars();

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Done!. For further details, Please Check Your . </div>');
            redirect('event_registration');
        }
    }

    public function cashmode() {
        $this->form_validation->set_rules('persname', 'Person Name', 'trim|required');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|is_numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['loginuser'] = $this->app_auth->appUserid();
            $data['country_code'] = $this->app_auth->appUserCountryCode();

            $total_cost = $this->session->userdata('total_cost');
            $data['total_amt'] = isset($total_cost) ? $total_cost : 0;

            $this->template->write_view("content", "payment_mode_cash", $data);
            $this->template->render();
        } else {
            // Read from Input.
            $person_name = $this->input->post('persname');
            $ph_no = $this->input->post('phone_no');

            // Session data.
            $mode_id = $this->session->userdata('mode_id');
            $total_cost = $this->session->userdata('total_cost');
            $payment_categary = 0;

            // Get logged in user ID.
            $user_id = $this->app_auth->appUserid();
            // Json String 
            $payment_json = '{"payment_details":[
                    {"personName":' . $person_name . ', "phoneNumber":" . ' . $ph_no . '"}
                ]}';
            // Payment Data array.
            $data_arr = array(
                'delegate_id' => $user_id,
                'payment_mode' => $mode_id,
                'total_cost' => $total_cost,
                'payment_reference_id' => $ref_id,
                'payment_details' => $payment_json,
                'payment_categary' => $payment_categary,
                'created_at' => date("Y-m-d H:i:s")
            );

            $this->delegate_event_registration_store();
            $this->db->insert('tbl_payment_refrence', $data_arr);  // Insert into tbl_payment_refernce Table.
            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Done!. For further details, Please Check Your Mail. </div>');
            redirect('event_registration');
        }
    }

    public function delegate_event_registration_store() {

        //insert the form data into database tables;
        $package_id_string = $this->session->userdata('package_details_id_str');
        $package_stage_id = $this->session->userdata('package_stage_id');
        $package_ids = explode('|', $package_id_string);

        // Get logged in user ID.
        $user_id = $this->app_auth->appUserid();

        for ($i = 0; $i < count($package_ids); $i++) {
            $data_store[] = array(
                'delegate_id' => $user_id,
                'package_id' => $package_ids[$i],
                'package_stage_id' => $package_stage_id,
                'date_of_registration' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            );
        }
        $return = $this->db->insert_batch('tbl_delegates_event_registration', $data_store);
    }

    public function unset_session_vars() {
        $array_items = array(
            'package_details_id_str' => '',
            '$package_stage_id' => '',
            'mode_id' => '',
            'total_cost' => ''
        );
        $this->session->unset_userdata($array_items);
    }

}
