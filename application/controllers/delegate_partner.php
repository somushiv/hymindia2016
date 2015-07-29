<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_Partner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('app_auth');
        $this->load->library('application_common_libs');
        $this->load->helper('hymindia');

        $this->load->database();
        $this->load->model('delegate_registration_model');

        $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }
    }

    public function index() {
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();

        $data['partner_details'] = $this->delegate_registration_model->getPartnerDetails($data['loginuser']);

        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "delegate_partner_view", $data);
        $this->template->render();
    }

    public function register() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('part-name', 'Partner Name', 'trim|required');
		
        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();

        $country_code = $this->delegate_registration_model->getCountryCode($data['loginuser']);
        $data['dele_mode'] = 1;
        if ($country_code == 'IN') {
            $data['dele_mode'] = 0;
        }
    	$partner_object=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$data['loginuser']);
        
        if ($partner_object->num_rows()){
        	$fieldRow=$partner_object->row();
        }else{
        	$fieldRowA = $this->db->list_fields('tbl_delegate_partner');
        	$fieldRow=array();
        	foreach($fieldRowA as $value){
        		$fieldRow[$value]='';
        	}
        	$fieldRow=(object)$fieldRow;
        	
        }

        if ($this->form_validation->run() == FALSE) {
            $data['food_pref'] = getFoodPref();
            $data['rels'] = getRelationships();
            $data['fieldRow']=$fieldRow;

            $this->template->add_css('/css/font-awesome.min.css');
            $this->template->write_view("content", "delegate_partner_register", $data);
            $this->template->render();
        } else {

            // Read all inputs.
            $partner_name = $this->input->post('part-name');
            $partner_rel = $this->input->post('part-relation');
            $partner_food = $this->input->post('part-food-pref');
            $about = $this->input->post('part-about');
            $passportno = $this->input->post('part-passport');

            // Payment Data array.
            $data_arr = array(
                'delegate_id' => $data['loginuser'],
            	'partner_title' => $this->input->post('partner_title'),
            	'sur_name' => $this->input->post('sur_name'),
            	'partners_clubnumber' => $this->input->post('partners_clubnumber'),
            	'partners_post_held' => $this->input->post('partners_post_held'),
                'delegate_partner_name' => $partner_name,
                'delegate_partner_food_pref' => $partner_food,
                'delagate_partner_rel' => $partner_rel,
                'delagate_partner_about' => $about,
                'delegate_partner_passport' => $passportno,
                'updated_at' => date("Y-m-d H:i:s")
            );
			if ($_POST['delegate_partner_id']>0){
				$this->db->update('tbl_delegate_partner', $data_arr,array('delegate_partner_id'=>$_POST['delegate_partner_id'])); 
				redirect("/dashboard");
			}else{
            $this->db->insert('tbl_delegate_partner', $data_arr);  // Insert into tbl_payment_refernce Table.
            redirect('/event_registration/registration_form');
			}
            
        }
    }

}
