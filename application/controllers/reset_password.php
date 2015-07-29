<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reset_Password extends CI_Controller {

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
        $this->load->helper("form");

        $this->load->database();
        $this->load->model('delegate_registration_model');
    }

    public function index() {
        $this->password_reset();
    }

    /*
     * Indian Registration
     */

    public function password_reset() {

        $this->load->library('form_validation');

        $data['loginuser'] = $this->app_auth->appUserid();

        $this->form_validation->set_rules('delegates_emailid', 'Email ID', 'callback_email_check');
        if ($this->form_validation->run() == FALSE) {

            $this->template->write_view("content", "forgot_password", $data);
            $this->template->render();
        } else {
            $email_id = $this->input->post('delegates_emailid');

            $pwdreset_arr = $this->delegate_registration_model->getEmailIDForPasswordReset($email_id);

            if (!$pwdreset_arr) {
                $this->load->library('session');
                //$this->session->set_userdata('registration_email_session', ' Thank you for Registering. Please check your email <br/>' . $queryRow->delegates_emailid);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">There is some problem in re-setting your password. </div>');
                //
                //redirect('/hymindia/hym_displayinfo');
                redirect(base_url());
            }

            $passwordGenerated = $this->app_auth->password_generate($pwdreset_arr['fname']);
            $this->sendregistrationmail($passwordGenerated, $pwdreset_arr['delegates_id']);
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Reset password successful. Please check your email for further details. </div>');
            //
            //redirect('/hymindia/hym_displayinfo');
            redirect(base_url());
        }
    }

    function sendregistrationmail($passwordGenerated, $last_inserted_id = 1) {
        $queryObject = $this->db->query("select a.*,b.* from tbl_delegates a join tbl_delegates_title b
											on a.delegates_title=b.title_id where a.delegates_id={$last_inserted_id}");
        $queryRow = $queryObject->row();

        $data['fullname'] = $queryRow->title_value . ' ' . $queryRow->delegates_firstname . ' ' . $queryRow->delegates_surname;
        $data['loginid'] = $queryRow->delegates_emailid;
        $data['password'] = $passwordGenerated;

        $email_body = $this->load->view('communication/registrationmail', $data, true);

        $this->load->library('email_lib');
        $emailArray = array(
            'fromid' => $this->config->item('admin_emailid'),
            'toids' => $queryRow->delegates_emailid,
            'body' => $email_body,
            'subject' => "HYM-India, 2016. Registration Mail " . date('m/d/Y')
        );
        $retValue = $this->email_lib->sendEmail($emailArray);
        /*if ($retValue) {
            $this->load->library('session');
            //$this->session->set_userdata('registration_email_session', ' Thank you for Registering. Please check your email <br/>' . $queryRow->delegates_emailid);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Thank you for Registering. Please check your email for further details. </div>');
            //
            //redirect('/hymindia/hym_displayinfo');
            redirect(base_url());
        }*/
    }

    public function email_check($email) {
        if (trim($email) == '') {
            $this->form_validation->set_message('email_check', '<span class="text-danger"><small>Please enter your Email ID.</small></span>');
            return FALSE;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('email_check', '<span class="text-danger"><small>Please enter valid Email ID.</small></span>');
            return FALSE;
        } else if (!$this->delegate_registration_model->getEmailID($email)) {
            $this->form_validation->set_message('email_check', '<span class="text-danger"><small>This Email Id is not registered.</small></span>');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
