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
            $this->load->library('app_auth');
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
			$this->load->helper('country');
			$country_details_arr = getCountryNameByIp();
			
			$delegates_mode=2;
			if ($country_details_arr['country_code']=='IN'){
				$delegates_mode=1;
			}
			
			$title_array=application_table_data('tbl_delegates_title','title_id','title_value');
			
			$delegateForm.=form_dropdown("delegates_title",$title_array,0,"Title"," class='widthfull' ");
			
			$delegateForm.=form_input("delegates_firstname",'',"* First Name"," class=' form-control ' placeholder='First Name' ");
			$delegateForm.=form_input("delegates_surname",'',"* Surname"," class=' form-control ' placeholder='Surname' ");
			$delegateForm.=form_input("delegates_clubnumber","","Club Number"," class=' form-control ' placeholder='Club Number' ","","",true);
			
			 $delegateForm.=form_input("delegates_emailid","","* Email ID"," class=' form-control ' placeholder='Email id' ","","",true);
			 $delegateForm.=form_input("delegates_phone","","Phone Number"," class=' form-control ' placeholder='Phone Number' ","","",true);
			$delegateForm.=form_input("delegates_mobile","","* Mobile Number"," class=' form-control ' placeholder='Mobile Number' ","","",true);
			$delegateForm.=form_input("delegates_address1","","Street Name"," class=' form-control ' placeholder='Street Name' ","","",true);
			$delegateForm.=form_input("delegates_address2","",""," class=' form-control ' placeholder='' ","","",true);
			$delegateForm.=form_input("delegates_city","","City/Town"," class=' form-control ' placeholder='City/Town' ","","",true);
			$delegateForm.=form_input("delegates_postalcode","","Postal Code"," class=' form-control ' placeholder='Postal Code' ","","",true);
			$country_array=getCountryByCode(NULL);
			$delegateForm.=form_dropdown("delegates_country",$country_array,$country_details_arr['country_code'],"Country"," class=' form-control ' placeholder='Country' ","","",true);
			$delegateForm.=form_dropdown("delegates_food_prefrence",function_food_prefrence(),0,"Food Prefrence"," class='widthfull' ");
			$delegateForm.="<div class='form-group '>
	<label class='control-label col-xs-2 ' for='delegates_allergies' >Special Requirements if any.</label>
	<div class='col-xs-10'>
		 <textarea id='delegates_allergies' name='delegates_allergies' class='  form-control '>
		 </textarea>
	</div>
</div>";
			$datahiden = array(
              'name'  => 'delegates_mode',
              'value' => $delegates_mode,
              'id'  => 'delegates_mode',
			  'class'  => 'delegates_mode',
            );
			$delegateForm.=form_input($datahiden);
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
			$this->template->add_js('js/delegates_registration.js',"import",FALSE,TRUE);
			$this->template->write_view("content","masterform",$data);
			$this->template->render();
		}
		public function processform(){
			$passwordGenerated=$this->app_auth->password_generate($this->input->post('delegates_firstname'));
			echo $passwordGenerated;
			exit;
			$enc_password=$this->app_auth->retPassword($passwordGenerated);
			$this->load->model("delegate_registration_model");
			$insert_id=$this->delegate_registration_model->update_registration($enc_password);
			
			$this->sendregistrationmail($passwordGenerated,$insert_id);
		}
		function sendregistrationmail($passwordGenerated,$last_inserted_id=1){
			$queryObject=$this->db->query("select a.*,b.* from tbl_delegates a join tbl_delegates_title b
											on a.delegates_title=b.title_id where a.delegates_id={$last_inserted_id}");
			$queryRow=$queryObject->row();
			
			
			
			
			 
					$data['fullname']=$queryRow->title_value.' '.$queryRow->delegates_firstname.' '.$queryRow->delegates_surname;
					$data['loginid']=$queryRow->delegates_emailid;
					$data['password']=$passwordGenerated;
				 
			
			$email_body=$this->load->view('communication/registrationmail',$data,true);
			
			$this->load->library('email_lib');
			$emailArray=array(
				'fromid'=> $this->config->item('admin_emailid'),
				'toids'=> $queryRow->delegates_emailid,
				'body'=> $email_body,
				'subject'=>"HYM-India, 2016. Registration Mail ".date('m/d/Y')
			);
			$retValue=$this->email_lib->sendEmail($emailArray);
			if ($retValue){
				$this->session->set_userdata('registration_email_session',' Thank you for Registering. Please check your email <br/>'.$queryRow->delegates_emailid);
				redirect('/hymindia/hym_displayinfo');
			}
		}
		public function testlib(){
			$this->load->helper('date');
			echo now();
		}
}
		