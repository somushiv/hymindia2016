<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paymentinformation extends CI_Controller {

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

       
    }
    public function paymentinput(){
    	 $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $delegate_id= $this->app_auth->appUserid();     
        $data['country_code'] = $this->app_auth->appUserCountryCode();
    	$this->template->write_view("content","paymentinformation_view",$data);
    	$this->template->render();
    }
}
?>