<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class paymentinfo extends CI_Controller {

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

        $this->dashboardview();
    }

	public function paymentinput(){
		//$payment_reference_array=$this->session->userdata('payment_reference_array');
//		print_r($payment_reference_array);
		
    	 $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $delegate_id= $this->app_auth->appUserid();    
        $payment_cost=$this->session->userdata('payment_cost');
        
        $data['payment_cost']=payment_panel($payment_cost);
        $totalCost=0;
        foreach ($payment_cost as $key=>$value){
        	//if ($key!="acc_cost_total"){
        		$totalCost=$totalCost+$value;
        	//}
        }
        //Check For Paid Cost
        $paidObject=$this->db->query('select * from tbl_payment_reference where delegate_id='.$delegate_id);
        $amount_paid=0;
        foreach ($paidObject->result() as $row){
        	$amount_paid=$amount_paid+$row->amount;
        }
        
        $data['totalCost']=$totalCost;
        $data['amount_paid']=$amount_paid;
        $data['amount_to_be_paid']=$totalCost-$amount_paid;
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        $this->template->add_js('js/validator.min.js',"import", FALSE, TRUE);
        $this->template->add_css('js/jquery.datetimepicker.css',"import");
        $this->template->add_js('js/jquery.datetimepicker.js',"import", FALSE, TRUE);
        $this->template->add_js("
        $(document).ready(function () {
        $('#myForm').validator();
        jQuery('#dated').datetimepicker({
				timepicker:false,
 				format:'d/m/Y'
			});
        });
        ","embed",false,true);
    	$this->template->write_view("content","paymentinformation_view",$data);
    	$this->template->render();
    }
    public function updatefeesdata(){
    	 $delegate_id= $this->app_auth->appUserid();    
    	$dataArray=array(
    		'paymentmode'=>$_POST['paymentmode'],
    		'paymentrefrence'=>$_POST['paymentrefrence'],
    		'amount'=>$_POST['amount'],
    		'totalcost'=>$_POST['totalprice'],
    		'dated'=>date('Y-m-d',strtotime($_POST['dated'])),
    		'bankname'=>$_POST['bankname'],
    		'bankcity'=>$_POST['bankcity'],
    		'bankbranch'=>$_POST['bankbranch'],
    		'notes'=>$_POST['notes'],
    		'delegate_id'=> $delegate_id,
    		'lastupdated'=>date('Y-m-d H:i:s')
    	
    	);
    	
    	$this->db->insert('tbl_payment_reference',$dataArray);
    	
    	$last_insertedObject=$this->db->query('select * from tbl_payment_reference 
    			where delegate_id='.$dataArray['delegate_id'].' and lastupdated="'.$dataArray['lastupdated'].'"');
    	$last_insertedRow=$last_insertedObject->row();
    	$last_insertedID=$last_insertedRow->payment_reference_id;
    	//$this->updatePaymentTrackerupdate($last_insertedID);
    	redirect("/dashboard");
    }

    function updatePaymentTrackerupdate($last_insertedID=0){
    	$this->load->library('lib_payment');
    	$this->load->library('app_auth');
    	$payment_reference_array=$this->session->userdata('payment_reference_array');
    	foreach($payment_reference_array as $keyObjectRef=>$valueObject){
    		//Fetch Table Name
    		$table_name=$this->lib_payment->tablename_reference($keyObjectRef);
    		//Update itineraries selected by delegate
    		foreach ($valueObject as $key=>$valueInsertObject){
    			$reference_object=json_encode($valueInsertObject);
    			$dataArray=array(
    				'payment_package'=>$keyObjectRef,
    				'register_reference_id'=>$valueInsertObject[0],
    				'package_reference_id'=>$valueInsertObject[1],
    				'amount'=>$valueInsertObject[2],
    				'payment_status'=>1,
    				'payment_reference_id'=>$last_insertedID,
    				'reference_object'=>$reference_object,
    				'delegate_id'=>$this->app_auth->appUserid(),
    				'updated_by'=>$this->app_auth->appUserid(),
    				'Notes'=>'',
    			);
    			
    			$this->db->insert('payment_tracker',$dataArray);
    			
    		}
    		
    	}
    }
    
}
