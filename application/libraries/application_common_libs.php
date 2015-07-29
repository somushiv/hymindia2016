<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package Common Libs from Sutrahealth
 * @author  Somushiv
 * @copyright  Copyright (c) 2013, 
 * @license http://gubbachi.org/gubbachilicense.html
 * @link http://gubbachi.org
 * @since   Version 1.0
 * @filesource
 */
class application_common_libs {

    var $ci;

    //Constructor

    function __construct() {
        $this->ci = & get_instance();
    }

    function getDelegateData($delegates_id = 0) {
        $delegates_id = isset($delegates_id) ? $delegates_id : 0;

        $queryObject = $this->ci->db->query("select * from tbl_delegates where delegates_id={$delegates_id}");
        if ($queryObject->num_rows() > 0) {
            return $queryObject->row();
        }
        return false;
    }

    function validateProfile($queryRow) {
        $return = true;
        if (empty($queryRow->delegates_address1)) {
            $return = false;
        }
        if (empty($queryRow->delegates_postalcode)) {
            $return = false;
        }
        if (empty($queryRow->delegates_country)) {
            $return = false;
        }
        if (empty($queryRow->delegates_food_prefrence)) {
            $return = false;
        }
        return $return;
    }
    /*
     * Delegate Profile Display
     */
    function delegate_profile_display(){
       $this->ci->load->library('app_auth');
        
        $delegatesObject = $this->getDelegateData($this->ci->app_auth->appUserid());
        //Validate Profile
        $validateProfile = $this->validateProfile($delegatesObject);
        
        if ($validateProfile) {
            $profile_alert = '<div class="alert alert-success text-center" role="alert">Profile Updated</div>';
        } else {
             $profile_alert = '<div class="alert alert-danger text-center" role="alert">Please Update Profile</div>';
        }
        $this->ci->load->helper('hymindia');
        $country=getCountryByCode($delegatesObject->delegates_country);
        $return = "
            <div class='col-sm-3 col-md-3'>
        <div class='panel panel-info'>
            <div class='panel-heading text-center'>Delegate Profile</div>
            <ul class='list-group'>
					<li class='list-group-item'><i class='glyphicon glyphicon-user' aria-hidden='true'></i>" . $delegatesObject->delegates_firstname . " " . $delegatesObject->delegates_surname . "</li>
					<li class='list-group-item'><i class='glyphicon glyphicon-envelope' aria-hidden='true'></i>" . $delegatesObject->delegates_emailid . "</li>					
					<li class='list-group-item'><i class='glyphicon glyphicon-earphone' aria-hidden='true'></i>" . $delegatesObject->delegates_mobile . "</li>
					<li class='list-group-item'><i class='glyphicon glyphicon-inbox' aria-hidden='true'></i>" . $delegatesObject->delegates_club_no . "</li>
					<li class='list-group-item'><i class='glyphicon glyphicon-inbox' aria-hidden='true'></i>" . $country . "</li>
					<li class='list-group-item'><i class='glyphicon glyphicon-inbox' aria-hidden='true'></i>" . $delegatesObject->delegates_hymcode . "</li>
					
				</ul>
            <div class='panel-footer'>
                ".$profile_alert."
            </div>
        </div>

    </div>
	";
        return $return;
    }
    /*
     * Delegate Registration Data
     */
    function delegate_event_registration_data($delegate_id){
    	 $queryObject = $this->ci->db->query("select * from tbl_delegates_event_registration where delegate_id={$delegate_id}");
    	 if ($queryObject->num_rows()==0){
    	 	return "";
    	 }else{
    	 	return $queryObject;
    	 }
    }
    
    function generate_hym_id($country_ref=null){
    	$this->ci->load->database();
    	
    	$queryObject = $this->ci->db->query("select count(*) as rowsx from tbl_delegates where delegates_country='{$country_ref}'");
    	$rownum=$queryObject->row();
    	$rownum=$rownum->rowsx;
    	
    	if ($country_ref=="IN"){
    		$prefix="NAGM";
    	}else{
    		$prefix="HYM";
    	}
    	$retNumber=$this->fixzero($rownum);
    	$returnValue=$prefix."/".$country_ref."/A".$retNumber;
    	return $returnValue;
    	
    }
    function fixzero($count){
    	
    	$count=(string)$count+1;
    	$length=strlen($count);
    	
    	switch($length){
    		case 1:
    			$returnvalue="00".$count;
    			break;
    		case 2:
    			$returnvalue="0".$count;
    			break;
    		case 3:
    			$returnvalue=$count;
    			break;
    			
    	}
    	return $returnvalue;
    }
    
}
