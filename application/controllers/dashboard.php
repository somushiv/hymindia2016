<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
            $this->load->library('app_auth');
            
            
            
       }
	
       public function index(){
			
			$this->dashboardview();
		}
		public  function dashboardview(){
			$this->load->library('application_common_libs');
			
			
			$delegatesObject=$this->application_common_libs->getDelegateData($this->app_auth->appUserid());
			//Validate Profile
			$validateProfile=$this->application_common_libs->validateProfile($delegatesObject);
			echo $validateProfile;
			if ($validateProfile){
				$data['profile_alert']='<div class="alert alert-success" role="alert">Profile Updated</div>';
			}else{
				$data['profile_alert']='<div class="alert alert-danger" role="alert">Please Update Profile</div>';
			}
			$data['profile']="
				<ul class='list-group'>
					<li class='list-group-item'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>".$delegatesObject->delegates_firstname." ".$delegatesObject->delegates_surname."</li>
					<li class='list-group-item'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span>".$delegatesObject->delegates_emailid."</li>					
					<li class='list-group-item'><span class='glyphicon glyphicon-earphone' aria-hidden='true'></span>".$delegatesObject->delegates_mobile."</li>
					<li class='list-group-item'><span class='glyphicon glyphicon-inbox' aria-hidden='true'></span>".$delegatesObject->delegates_club_no."</li>
				</ul>
			";
			$data['loginuser']=$this->app_auth->appUserid();
			$this->template->add_css('/css/font-awesome.min.css');
			$this->template->write_view("content","dashboard",$data);
			$this->template->render();
		}
}		