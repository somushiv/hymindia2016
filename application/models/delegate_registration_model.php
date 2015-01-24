<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Bcustomer_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
    	function update_registration(){
    		 $dataArray=array(
                'delegate_firstname'=>$this->input->post('delegate_firstname'),
    		 	'delegate_surname'=>$this->input->post('delegate_surname'),
    		 	'delegate_emailid'=>$this->input->post('delegate_emailid'),
    		 	'delegate_clubnumber'=>$this->input->post('delegate_clubnumber'),
    		 	
    		);
    		$this->db->insert('tbl_delegates',$dataArray);
    	}    
 }