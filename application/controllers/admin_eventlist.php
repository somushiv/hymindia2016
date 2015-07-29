<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_eventlist extends CI_Controller {

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
    public function listeventdelegates($country_mode=""){
    	$data['loginuser']="Admin";
    	$where=" delegates_country='{$country_mode}'";
    	if (empty($country_mode)){
    		$where=" not (delegates_country='IN')";
    	}
    	
    	$recordObject=$this->db->query("select * from tbl_delegates where ".$where);
    	$returnValue='';
    	$this->load->helper("hymindia");
    	$headData=$this->fetch_heading($country_mode);
    	foreach($recordObject->result() as $row){
    		$returnValue.='<tr>';
    		$country_word=getCountryByCode($row->delegates_country,$headData[2]);
    		$d=$row->delegates_firstname.' '.$row->delegates_surname.'(<a href="#" data-toggle="tooltip" title="'.$country_word.'">'.$row->delegates_country.'</a>)';
    		
    		$returnValue.='<td>'.$d.'</td>';
    		
    		$returnValue.='<td>'.$row->delegates_hymcode.'</td>';
    		$returnValue.=$this->fetch_delegates_event_details($row->delegates_id);
    		$returnValue.='</tr>';
    	}
    	
    	//UI Fix
    	
    	$returnValue1='<table class="table table-striped table-hover"><thead><tr>'.$headData[1].'</tr></thead>
    			<tbody>'.$returnValue.'</tbody></table>';
    	$data['displayvalue']=$returnValue1;
        $this->template->add_js("$(document).ready(function(){
    $('[data-toggle=\"tooltip\"]').tooltip();
});","embed",false,true);
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "admindashboardlist1", $data);
        $this->template->render();
    } 

    function fetch_heading($country_mode=''){
    	if ($country_mode=="IN"){
    		$country_mode=1;
    	}else{
    		$country_mode=2;
    		
    	}
    	
    	$rObject=$this->db->query('select * from tbl_packages_details where country_mode='.$country_mode.' and published=1 order by packages_details_id');
    	$theads='';
    	$rowHead='<th>D.Name</th><th>HYM ID</th>';
    	$i=1;
    	foreach ($rObject->result() as $row){
    		$theads.="<tr><td>#{$i}</td><td>{$row->packages_title}</td></tr>";
    		$xyz='<a href="#" data-toggle="tooltip" title="'.$row->packages_title.'">#'.$i.'</a>';
    		$rowHead.="<th>{$xyz}</th>";
    		$i++;
    	}
    	$rowHead='<tr>'.$rowHead.'</tr>';
    	$j=$i-1;
    	return array($theads,$rowHead,$j);
    	
    }
    function fetch_delegates_event_details($delegate_id,$event_count=10){
    	$queryObject=$this->db->query('select * from tbl_delegates_event_registration where delegate_id='.$delegate_id.' order by package_id');
    	$returnValue='';
    	
    	if ($queryObject->num_rows()==0){
    		$returnValue.='<td colspan="'.$event_count.'">Not Registred</td>';
    	}else{
    		foreach ($queryObject->result() as $row){
    			if ($row->delegate_numbers==0){
    				$numbers='-';
    			}else{
    				$numbers=$row->delegate_numbers;
    			}
    			$returnValue.='<td>'.$numbers.'</td>';
    		}
    	}
    	return $returnValue;
    }

}
