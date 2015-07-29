<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_registration extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('app_auth');

        $this->load->helper("hymindia");
        
        $is_user_logged_in = $this->app_auth->appUserid();
        if ($is_user_logged_in) {
            redirect('dashboard');
        }
    }

    public function index() {
    	
        $this->newregistration();
    }

    /*
     * Indian Registration
     */

    public function newregistration() {
        // Push Data to Template
        $this->load->helper("form");
        $this->load->helper('application_common');
       
        $country_details_arr = getCountryNameByIp();

        $delegates_mode = 2;
        if ($country_details_arr['country_code'] == 'IN') {
            $delegates_mode = 1;
        }

        $this->load->library('form_validation');

        $data['loginuser'] = $this->app_auth->appUserid();
        $data['titles'] = application_table_data('tbl_delegates_title', 'title_id', 'title_value');
        $data['country_array'] = getCountryByCode(NULL);
        $data['country_code'] = $country_details_arr['country_code'];

        


        
        	
        	$this->template->add_js('js/validator.min.js',"import", FALSE, TRUE);
        	$this->template->add_js('js/registrationvalidation.js',"import", FALSE, TRUE);
            $this->template->write_view("content", "delegate_registration_view", $data);
            $this->template->render();
       
    }
     function updatedelegate_registration(){
     	
     	$passwordGenerated = $this->app_auth->password_generate($this->input->post('delegates_firstname'));
            //echo $passwordGenerated;
            // exit;
            $enc_password = $this->app_auth->retPassword($passwordGenerated);
           
            $this->load->model("delegate_registration_model");
            $insert_id = $this->delegate_registration_model->update_registration($enc_password);
            $this->sendregistrationmail($passwordGenerated, $insert_id);
            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Thank you for registering. Please check email for further details.</div>');
            redirect(base_url());
     }
    
    function validedatemail(){
    	$email = mysql_real_escape_string(strtolower($_POST["email"]));
    	$sql = "SELECT delegates_emailid FROM tbl_delegates WHERE LOWER(delegates_emailid) = '" . $email . "'";
		$result = $this->db->query($sql);
 
		if($result->num_rows() > 0) {
    	//email is already taken
    	echo 1;
	}
	else {
    //email is available
    	echo 0;
	}
    }
    function sendregistrationmail($passwordGenerated="somu", $last_inserted_id = 1) {
        $queryObject = $this->db->query("select a.*,b.* from tbl_delegates a join tbl_delegates_title b
											on a.delegates_title=b.title_id where a.delegates_id={$last_inserted_id}");
        $queryRow = $queryObject->row();

        $data['fullname'] = $queryRow->title_value . ' ' . $queryRow->delegates_firstname . ' ' . $queryRow->delegates_surname;
        $data['loginid'] = $queryRow->delegates_emailid;
        $data['password'] = $passwordGenerated;
        $data['hymindiaid'] = $queryRow->delegates_hymcode;

        $email_body = $this->load->view('communication/registrationmail', $data, true);

        $this->load->library('email_lib');
        $emailArray = array(
            'fromid' => $this->config->item('admin_emailid'),
            'toids' => $queryRow->delegates_emailid,
        	'tocc'=>"hym@hymindia.org",
            'body' => $email_body,
            'subject' => "HYM-India, 2016. Registration Mail " . date('m/d/Y')
        );
        $retValue = $this->email_lib->sendEmail($emailArray);
        if ($retValue) {
            $this->load->library('session');
            //$this->session->set_userdata('registration_email_session', ' Thank you for Registering. Please check your email <br/>' . $queryRow->delegates_emailid);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Thank you for Registering. Please check your email for further details. </div>');
            //
            //redirect('/hymindia/hym_displayinfo');
            redirect(base_url());
        }
    }

    public function testlib() {
        $this->load->helper('date');
        echo now();
    }

    public function title_check($index) {
        if ($index == 0) {
            $this->form_validation->set_message('title_check', '<span class="text-danger"><small>Please select title</small></span>');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
