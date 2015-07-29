<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hymindia extends CI_Controller {

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
        $this->load->helper("form");
        
    }

    public function index() {

        $this->eventdetails();
    }

    public function eventdetails() {

        $data['environment'] = ENVIRONMENT;
        $errorMessage = $this->session->flashdata('errormessage');
        if (!empty($errorMessage)) {
            $data['errorMessage'] = $errorMessage;
            $this->template->write_view("content", "hym_homepage", $data);
        } else {
            $this->template->write_view("content", "hym_homepage");
        }
        $this->template->render();
    }

    public function loginscreen() {
        $errorMessage = $this->session->flashdata('errormessage');
        if (!empty($errorMessage)) {
            $data['errorMessage'] = $errorMessage;
            $this->template->write_view("content", "login", $data);
        } else {
            $this->template->write_view("content", "login");
        }

        $this->template->render();
    }

    public function processform($value = '') {

        $this->load->library("app_auth");
        if (($_POST['delegates_emailid']=='hym@hymindia.org')&&($_POST['delegates_password']=='admin@123')){
        	$this->load->library('session');
        	$this->session->set_userdata('adminlogin','loggedin');
        	redirect("/admindashboard");
        }else{
        $loginReturn = $this->app_auth->checkUser($_POST['delegates_emailid'], $_POST['delegates_password']);

        if ($loginReturn == true) {
            redirect("/dashboard");
        } else {
            $this->session->set_flashdata('errormessage', "Invalid Username/Password");
            redirect("/");
        }
        }
    }

    public function logout() {
        $this->load->library("session");
        $this->session->sess_destroy();
        redirect($this->config->item('base_url'));
    }

    public function hym_displayinfo() {
        $data['errorMessage'] = $this->session->userdata('registration_email_session');
        $this->session->unset_userdata('registration_email_session');

        $this->template->write_view("content", "hym_displayinfo", $data);
        $this->template->render();
    }

    /*
     * Registration Form Validation
     * Indian Registration = 1
     * International Registration = 2
     */
}
