<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Delegate_registration_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
    	function update_registration($genpassword){
    		
    		
    		 $dataArray=array(
    		 	'delegates_title'=>$this->input->post('delegates_title'),
                'delegates_firstname'=>$this->input->post('delegates_firstname'),
    		 	'delegates_surname'=>$this->input->post('delegates_surname'),
    		 	'delegates_emailid'=>$this->input->post('delegates_emailid'),
    		 	'delegates_club_no'=>$this->input->post('delegates_clubnumber'),
    		 	'delegates_emailid'=>$this->input->post('delegates_emailid'),
    		 	'delegates_mobile'=>$this->input->post('delegates_mobile'),
    		    'delegates_country'=>$this->input->post('delegates_country'),
    		 	'delegates_phone'=>$this->input->post('delegates_phone'),
    		 	'delegates_address1'=>$this->input->post('delegates_address1'),
    		 	'delegates_address2'=>$this->input->post('delegates_address2'),
    		 	'delegates_city'=>$this->input->post('delegates_city'),
    		 	'delegates_postalcode'=>$this->input->post('delegates_postalcode'),
    		 	'delegates_allergies'=>$this->input->post('delegates_allergies'),
    		 	'delegates_food_prefrence'=>$this->input->post('delegates_food_prefrence'),
    		 	
    		 	'delegates_mode'=>$this->input->post('delegates_mode'),
    		 	'delegates_password'=>$genpassword,
    		);
    		$this->db->insert('tbl_delegates',$dataArray);
    		return $this->db->insert_id();

    		
    	}    
 }