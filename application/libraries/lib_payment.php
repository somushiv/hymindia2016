<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * IMTMA,eMAIL SEND OUT CLASS
 *
 * This class is and interface to CI's View class. It aims to improve the
 * interaction between controllers and views. Follow @link for more info
 *
 * @package   email_lib
 * @author    SomuShiv
 * @subpackage  Libraries
 * @category  Libraries
 * @link    http://WWW.TATWAA.IN
 * @copyright  Copyright (c) tATWAA
 * @version 1
 * 
 */
class lib_payment {
  var $ciObject;
  //Constructor
  
  
  function __construct() {
    $this->ciObject=& get_instance();
  }
  function process_list($var=''){
  	$hackArray=array(
  	'event_registrion','accommodation','tours','day_trip','drop_pickup'
  	);
  	
  	
  	$listArray=array(
  		'event_registrion'=>'Event Registrion',
  		'accommodation'=>'Accommodation',
  		'tours'=>'Tours',
  		'day_trip'=>'Day Trip',
  		'drop_pickup'=>'Drop/Pickup',
  		
  	);
  	if (is_numeric($var)){
  		return $listArray[$hackArray[$var]];
  	}else{
  		return $listArray;
  	}
  }
  function tablename_reference($var=''){
  	$table_name=array(
  		'tbl_delegates_event_registration','tbl_accomodation',
  		'tbl_tour_registration','daytour_registration','tbl_transporation'
  	);
  	if (is_numeric($var)){
  		return $table_name[$var];
  	}else{
  		return $table_name;
  	}
  	
  }
}