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
    	 $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $delegate_id= $this->app_auth->appUserid();    
        $payment_cost=$this->session->userdata('payment_cost');
        
        $data['payment_cost']=$payment_cost;
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
        $this->template->add_css('js/jquery.datetimepicker.css',"import");
        $this->template->add_js('js/jquery.datetimepicker.js',"import", FALSE, TRUE);
        $this->template->add_js("
        $(document).ready(function () {
        jQuery('#dated').datetimepicker();
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
    		'dated'=>$_POST['dated'],
    		'bankname'=>$_POST['bankname'],
    		'bankcity'=>$_POST['bankcity'],
    		'bankbranch'=>$_POST['bankbranch'],
    		'notes'=>$_POST['notes'],
    		'delegate_id'=> $delegate_id,
    	
    	);
    	$this->db->insert('tbl_payment_reference',$dataArray);
    
    	redirect("/dashboard");
    }

}
