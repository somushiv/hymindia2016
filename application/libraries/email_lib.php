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
class email_lib {
  var $ciObject;
  //Constructor
  
  
  function __construct() {
    $this->ciObject=& get_instance();
  }
  function sendEmail($emailArray){
    $CI=$this->ciObject;
   
    $CI->load->library('email');  
    $CI->email->clear();
     $e_config['protocol']='smtp';
     $e_config['smtp_host']='ssl://cpanel29.interactivedns.com';
     $e_config['smtp_port']='465';
     $e_config['smtp_timeout']='30';
     $e_config['smtp_user']='registration@hymindia.org';
     $e_config['smtp_pass']='hymindia@123';
     $e_config['useragent']='mutt';
    //$e_config['protocol'] = 'sendmail';
  //  $e_config['mailpath'] = '/usr/sbin/sendmail';
    $e_config['charset']='utf-8';
    $e_config['newline']="\r\n";
    $e_config['wordwrap'] = TRUE;
    $e_config['mailtype'] = 'html';
    $CI->email->initialize($e_config); 
    
    
    
    $CI->email->from($emailArray['fromid']);  
    $CI->email->to($emailArray['toids']);  
    $CI->email->subject($emailArray['subject']);  
    $CI->email->message($emailArray['body']); 
    
    if (isset($emailArray['tocc'])){
      $CI->email->cc($emailArray['tocc']); 
      
    }
     
    if (isset($emailArray['attach'])){
      
      foreach($emailArray['attach'] as $attachmentfile){
        if (!empty($attachmentfile)){
        $CI->email->attach($attachmentfile);
        }
      }
    }
  
    if (!$CI->email->send()){
         $retvalue= $CI->email->print_debugger();
    }else{
        
      $retvalue=1;
    }
    
    return $retvalue;
}
}
?>
