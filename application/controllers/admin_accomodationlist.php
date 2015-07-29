<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_accomodationlist extends CI_Controller {

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
        
    }

    public function index() {

        $this->listeventdelegates();
    }

    public function dashboardview($country_mode=0) {

		$data='';
        
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "admindashboard", $data);
        $this->template->render();
        
    }
    public function listdelegates($country_mode=""){
    	$data['loginuser']="Admin";
    $where=" delegates_country='{$country_mode}'";
    	if (empty($country_mode)){
    		$where=" not (delegates_country='IN')";
    	}
    	
    	$recordObject=$this->db->query("select * from tbl_delegates where ".$where);
    	$returnValue='';
    	$this->load->helper("hymindia");
    	 
    	foreach($recordObject->result() as $row){
    		$returnValue.='<tr>';
    		$country_word=getCountryByCode($row->delegates_country);
    		$d=$row->delegates_firstname.' '.$row->delegates_surname.'(<a href="#" data-toggle="tooltip" title="'.$country_word.'">'.$row->delegates_country.'</a>)';
    		
    		$returnValue.='<td>'.$d.'</td>';
    		
    		$returnValue.='<td>'.$row->delegates_hymcode.'</td>';
    		$returnValue.=$this->fetch_delegates_details($row->delegates_id);
    		$returnValue.='</tr>';
    	}
    	
    	//UI Fix
    	
    	$returnValue1='<table class="table table-striped table-hover"><thead><tr><th>D.Name</th><th>HYM ID</th><th>Accomodation</th>
    	<th>Check-In</th><th>Check-Out</th>
    	</tr></thead>
    			<tbody>'.$returnValue.'</tbody></table>';
    	$data['displayvalue']=$returnValue1;
        $this->template->add_js("$(document).ready(function(){
    $('[data-toggle=\"tooltip\"]').tooltip();
});","embed",false,true);
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "admindashboardlist1", $data);
        $this->template->render();
    } 

    function fetch_delegates_details($delegate_id=''){
    	
    	
    	$rObject=$this->db->query('select * from tbl_accomodation a join tbl_accomodation_place b
    	on a.accomodation_place_id=b.accomodation_place_id			
    	where delegate_id='.$delegate_id);
    	$theads='';
    	 
    	 
    	foreach ($rObject->result() as $row){
    		$theads.="<td>{$row->accomodation_place_name}</td>";
    		$checkin_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $row->check_in_date_time);
    		$checkout_datetime=DateTime::createFromFormat('Y-m-d H:i:s', $row->check_out_date_time);
    		$checkin_datetime=$checkin_datetime->format('m/d/y h:i a');
    		$checkout_datetime=$checkout_datetime->format('m/d/y h:i a');
    		 
    		$theads.="<td>{$checkin_datetime}</td>";
    		$theads.="<td>{$checkout_datetime}</td>";
    		
    		 
    	}
    	 
    	return $theads;
    	
    }
   

}
