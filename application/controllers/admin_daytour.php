<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_daytour extends CI_Controller {

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
    $where=" country_mode=1";
    	if (empty($country_mode)){
    		$where="  (country_mode=2)";
    	}
    	
    	$recordObject=$this->db->query("SELECT * FROM daytours_packages where ".$where.' and published=1 order by daytours_id');
    	$returnValue='';
    	$this->load->helper("hymindia");
    	 $prepost=array('','Pre Tour','Post Tour');
    	
    	foreach($recordObject->result() as $row){
    		
    		$returnValue.='<tr>';
    		
    		$d=$row->tour_name;
    		
    		$returnValue.='<td>'.$d.'</td><td></td><td></td><td></td><td></td></tr>';
    		
    		
    		$returnValue.=$this->fetch_delegates_details($row->daytours_id);
    		
    	}
    	
    	//UI Fix
    	
    	$returnValue1='<table class="table table-striped table-hover"><thead><tr><th>Tours</th><th>D.Name</th>
    	<th>HYM ID</th><th>Relationship</th><th>Date</th>
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

    function fetch_delegates_details($daytours_id=''){
    	
    	
    	$rObject=$this->db->query('select * from daytour_registration a join tbl_delegates b
    	on a.delegate_id=b.delegates_id			
    	where daytour_reference='.$daytours_id.' order by a.delegate_id,relationship_id desc');
    	$returnValue='';
    	 
    	  $coupleMode=array('','Single','Double');
    	 $this->load->helper('hymindia_helper');
    	foreach ($rObject->result() as $row){
    		$returnValue.="<tr><td></td>";
    		$d=$row->delegates_firstname.' '.$row->delegates_surname;    		 
    		$returnValue.="<td>{$d}</td>";
    		$returnValue.='<td>'.$row->delegates_hymcode.'</td>';
    		$relationship=getRelationships($row->relationship_id);
    		$tourDate=daytourdates($row->date_refrence);
    		$returnValue.="<td>{$relationship}</td>
    			<td>{$tourDate}</td>
    		</tr>";
    		
    		 
    	}
    	 
    	return $returnValue;
    	
    }
   

}
