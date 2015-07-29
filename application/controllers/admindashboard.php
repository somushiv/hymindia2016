<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends CI_Controller {

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
		
    $this->load->library('app_auth');
       

       
        	$this->dashboardview();
        
    }

    public function dashboardview($country_mode=0) {

		$data='';
        $data['loginuser']="Admin";
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "admindashboard", $data);
        $this->template->render();
        
    }
    public function listdelegates($country_mode=""){
    	
    	$where=" delegates_country='{$country_mode}'";
    	if (empty($country_mode)){
    		$where=" not (delegates_country='IN')";
    	}
    	
    	$recordObject=$this->db->query("select * from tbl_delegates where ".$where);
    	$returnValue='';
    	$this->load->helper("hymindia");
    	foreach($recordObject->result() as $row){
    		$returnValue.='<tr>';
    		$d=$row->delegates_firstname.' '.$row->delegates_surname;
    		$country_word=getCountryByCode($row->delegates_country);
    		$returnValue.='<td>'.$d.'</td>';
    		$returnValue.='<td><a href="#" data-toggle="tooltip" title="'.$country_word.'">'.$row->delegates_country.'</a></td>';
    		$returnValue.='<td>'.$row->delegates_mobile.'</td>';
    		$returnValue.='<td>'.$row->delegates_emailid.'</td>';
    		$returnValue.='<td>'.$row->delegates_club_no.'</td>';
    		$returnValue.='<td>'.$row->delegates_hymcode.'</td>';
    		$returnValue.='</tr>';
    	}
    	$data['loginuser']="Admin";
    	$data['displayvalue']=$returnValue;
        $this->template->add_js("$(document).ready(function(){
    $('[data-toggle=\"tooltip\"]').tooltip();
});","embed",false,true);
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "admindashboardlist", $data);
        $this->template->render();
    } 


}
