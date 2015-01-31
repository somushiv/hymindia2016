<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * IMTMA, ACL Management Class
 *
 * This class is and interface to CI's View class. It aims to improve the
 * interaction between controllers and views. Follow @link for more info
 *
 * @package     Appaaccess
 * @author      SomuShiv
 * @subpackage  Libraries
 * @category    Libraries
 * @link        http://WWW.TATWAA.IN
 * @copyright  Copyright (c) tATWAA
 * @version 1
 * 
 */
class App_auth {
    var $ciObject;
    //Constructor
    
    function __construct() {
        $this->ciObject=& get_instance();
    }
    function checkUser($username,$password){
    	
    	
        $qryAccess=$this->ciObject->db->query(
        'select * from tbl_delegates where 
          delegates_emailid="'.$username.'" and 
          delegates_password="'.$this->_encryptme($password).'"'
        );
       
       
        if ($qryAccess->num_rows()==1){
            $rowdata=$qryAccess->row();
            $this->_setsession($rowdata);
            return true;
        }else{
            return false;
        }
    }
    /*
     * Login Session Check
     */
    function validatelogin1(){
        $this->ciObject->load->library('session');      
        $tempVar=$this->ciObject->session->userdata('usersession');
     $this->ciObject->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        if (empty($tempVar)){
                $this->ciObject->load->helper('url');
        redirect($this->ciObject->config->item('base_url'));
        }else{
            return true;
        }
    }
    /*
     * Password Encryption Private Method
     */
    function password_generate($password=''){
    	return strtolower(preg_replace('/\s+/', '', $password));    	
    }
	
    private function _encryptme($encstring){        
        return md5($encstring);
    }
  function reset_pass($newpass){
    $encrptedpassword=$this->_encryptme($newpass);
    return $encrptedpassword;
  }
    function retPassword($password){
        return $this->_encryptme($password);
    }
    /*
     * Sets Session Private Methdo 
     */
    function _setsession($rowdata){
        $sessionArray=array(
            'fullname'=>$rowdata->delegates_firstname.' '.$rowdata->delegates_surname,
            'emailid'=>$rowdata->delegates_emailid,
            'userid'=>$rowdata->delegates_id,
            'groupid'=>$rowdata->delegates_group,
            'delegates_hym_id'=>$rowdata->delegates_hym_id,
        	 'delegates_mode'=>$rowdata->delegates_mode,
        );
        $this->ciObject->load->library('session');
        $this->ciObject->session->set_userdata('usersession',$sessionArray);
    }
    /*
     * To Provide Required Session Info
     */
    function appUsername(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['fullname'];
    }
    function appUseremailid(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['emailid'];
    }   
    function appUserid(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['userid'];
    }   
    function appUserMode(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['delegates_mode'];
    }   
    function appUsergroupid(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['groupid'];
    }
    function appStudyCenter(){
        $this->ciObject->load->library('session');
        $sessionArray=$this->ciObject->session->userdata('usersession');
        return $sessionArray['reference_id'];
    }   
   
   
  function aclmanage($accasscheck){
    $arrayAcl=array(
      'eventdashboard'=>array(1,2,3,4,5)
    );
    $chkArray=$arrayAcl[$accasscheck];
    if (in_array($this->appUsergroupid(),$chkArray)==FALSE){
      redirect('/dashboard/showdashboard');
    }
  }
  /*
     * Login Session Check
     */
    function validatelogin(){
        $this->ciObject->load->library('session');      
        $tempVar=$this->ciObject->session->userdata('usersession');
     $this->ciObject->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        if (empty($tempVar)){
                $this->ciObject->load->helper('url');
        //redirect($this->ciObject->config->item('base_url'));
            return false;
        }else{
            return true;
        }
    }
}
