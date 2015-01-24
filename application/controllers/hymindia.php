<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hymindia extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
       {
            parent::__construct();
       }
	
       public function index(){
	
			$this->eventdetails();
		
		}
		public function eventdetails(){
			$this->load->helper("form");
			 
			$data['environment']=ENVIRONMENT;			
			$this->template->write_view("content","hym_homepage",$data);
			$this->template->render();
		}
		/*
		 * Registration Form Validation
		 * Indian Registration = 1
		 * International Registration = 2
		 */
		
		
	}