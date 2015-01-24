<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delegate_registration extends CI_Controller {

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
	
			$this->newregistration();
		
		}
		/*
		 * Indian Registration
		 */
		public function newregistration(){
			// Push Data to Template
			$this->load->helper("form");
			$delegateForm='';
			
			$this->load->helper('application_common');
			
			$title_array=application_table_data('tbl_delegates_title','title_id','title_value');
			
			$delegateForm.=form_dropdown("customer_title",$title_array,0,"Title"," class='widthfull' ");
			
			$delegateForm.=form_input("delegate_firstname",'',"* First Name"," class=' form-control ' placeholder='First Name' ");
			$delegateForm.=form_input("delegate_surname",'',"* Sur Name"," class=' form-control ' placeholder='Sur Name' ");
			
			 $delegateForm.=form_input("delegate_emailid","","* Email ID"," class=' form-control ' placeholder='Email id' ","","",true);
			$delegateForm.=form_input("delegate_clubnumber","","Club Number"," class=' form-control ' placeholder='Club Number' ","","",true);
			$aformfooter = array(
            'name' => 'submit',
            'id' => 'submit',            
            'type' => 'submit',
            'content' => 'Submit',
            'class' => 'btn btn-primary'
        );
        $delegateFooter=form_button($aformfooter);
			
			$data['formopen']=array(
				'formaction'=>"/delegate_registration/processform",
				'formclass'=>"form-horizontal"
				);
			$data['formtitle']='Delegates Registration';
			$data['formcontent']=$delegateForm;	
			$data['formfooter']=$delegateFooter;
			#$this->template->add_js('/js/jquery_validation.js');
			#$this->template->add_js('/js/registration.js');
			$this->template->write_view("content","masterform",$data);
			$this->template->render();
		}
		public function processform(){
			$this->load->model("delegate_registration");
			$this->delegate_registration->update_registration();
		}
		public function testlib(){
			$this->load->helper('application_common');
			
			$returnObject=application_table_data('tbl_delegates_title','title_id','title_value');
			print_r($returnObject);
		}
}
		