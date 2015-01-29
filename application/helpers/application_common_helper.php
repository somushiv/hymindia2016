<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2013, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

//--------------------------------------------------------------------

/**
 * Form Helpers
 *
 * Creates HTML5 extensions for the standard CodeIgniter form helper.
 *
 * These functions also wrap the form elements as necessary to create
 * the styling that the Bootstrap-inspired admin theme requires to
 * make it as simple as possible for a developer to maintain styling
 * with the core. Also makes changing the core a snap.
 *
 * All methods (including overridden versions of the originals) now
 * support passing a final 'label' attribute that will create the
 * label along with the field.
 *
 * @package    Bonfire
 * @subpackage Helpers
 * @category   Helpers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/array_helpers.html
 *
 */

if ( ! function_exists('application_table_data'))
{
	function application_table_data($table_name='',$key_id='',$display_value='',$return_key=''){
     	$where='';
     	 $ci=& get_instance();
     	if (!empty($return_key)){
     		$where = " where {$key_id}={$return_key}";
     	}
     	$queryString="select * from {$table_name} {$where} order by {$key_id}";
     	$queryObject=$ci->db->query($queryString);
     		if (!empty($return_key)){
     			$returnObject=$queryObject->row_array();
     		}else{
     			$returnObject=array();
     			$returnObject[]='-- Select --';
     			foreach ($queryObject->result_array() as $row){
     				$returnObject[$row[$key_id]]=$row[$display_value];
     			}
     		}
     		return  $returnObject;
     	}	
}
if (!function_exists('function_food_prefrence')){
	function function_food_prefrence($retData=''){
		$foot_prefrenceArray=array(
			'--Select--',
			'vegetarian',
			'Non vegetarian'
		);
		if (empty($retData)){
			return $foot_prefrenceArray;
		}else{
			return $foot_prefrenceArray[$retData];
		}
		
	}
}
