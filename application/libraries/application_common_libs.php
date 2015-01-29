<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
        $this->ci=& get_instance();
    }
     
    function getDelegateData($delegates_id=0){
    	$queryObject=$this->ci->db->query("select * from tbl_delegates where delegates_id={$delegates_id}");
    	return $queryObject->row();
    }
    function validateProfile($queryRow){
    	$return=true;
    	if (empty($queryRow->delegates_address1)){
    		$return=false;
    	}
    	if (empty($queryRow->delegates_postalcode)){
    		$return=false;
    	}
   		 if (empty($queryRow->delegates_country)){
    		$return=false;
    	}
    	if (empty($queryRow->delegates_food_prefrence)){
    		$return=false;
    	}
    	return $return;
    }
    
     	
 }
 