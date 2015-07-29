<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daytours_registration extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('app_auth');
        
        $this->load->library('application_common_libs');

        
        $this->load->library('session');
        $this->load->helper('hymindia');


        $this->load->database();
        $this->load->model('delegate_registration_model');

        $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }

        $this->template->add_css('css/bootstrap-datetimepicker.min.css');
        $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
//        $this->template->add_css('css/bootstrap-datetimepicker.min.css');
  //      $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
      
    }
	public function index(){
		
	}
	function registration(){
		 $this->load->helper('hymindia');
    	$this->load->helper("form");
    	$data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        
        $country_code = hlpcountry_mode($this->app_auth->appUserCountryCode());
		
        //Pull out Attendees
        $partnerobject=$this->db->query('select * from tbl_delegate_partner where delegate_id='.$data['loginuser']);
        //Featch Day Tour details
        $daytourObject=$this->db->query('select * from daytours_packages where country_mode='.$country_code.' and published=1');
        $daytourData='';
        $i=1;
        foreach ($daytourObject->result() as $row){
        	$daytourData.='<tr>';
        	$daytourData.='<td>'.$i.'</td>';
        	$daytourData.='<td>'.$row->tour_name.'</td>';
        	$daytourData.='<td>'.number_format($row->tour_cost).'</td>';
        	$partnersData=$this->partners_details($partnerobject,$row->tour_cost,$row->daytours_id,$data['loginuser']);
        	
        	$daytourData.='<td>'.$partnersData[0].'</td>';
        	//$daytourData.='<td>'.$partnersData[1].'</td>';
        	$daytourData.='</tr>';
        	$i++;
        }
        
        $data['daytourData']=$daytourData;
        $this->template->add_js("js/daytour.js", "import", FALSE, TRUE);
		 $this->template->write_view("content", "daytour_registration_view", $data);
        $this->template->render();
	}
	function validatedata($daytours_id,$loginuser,$relationship_id){
	$daytour_object=$this->db->query('select * from daytour_registration where 
				delegate_id='.$loginuser.' and 
				daytour_reference='.$daytours_id.' and relationship_id=	'.$relationship_id);
        
        if ($daytour_object->num_rows()){
        	$fieldRow=$daytour_object->row();
        }else{
        	$fieldRowA = $this->db->list_fields('daytour_registration');
        	$fieldRow=array();
        	foreach($fieldRowA as $value){
        		$fieldRow[$value]='';
        	}
        	$fieldRow=(object)$fieldRow;
        	
        }
        return $fieldRow;
	}
	function partners_details($partnerObject,$cost,$daytours_id,$loginuser){
		$fieldRow=$this->validatedata($daytours_id, $loginuser,101);
		$returnData='';
		 $this->load->helper('hymindia');
		$datesArray=daytourdates();
		$amoutDisplay='';
		
		$dayDropdown='<select name="date-101-'.$daytours_id.'" class="date-101-'.$daytours_id.'">';
			foreach($datesArray as $key=>$value){
				$selected='';
				if (($fieldRow->relationship_id==101)&&($fieldRow->date_refrence==$key)&&($fieldRow->daytour_reference==$daytours_id))
					$selected=' selected ';
				$dayDropdown.='<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
			}
			$dayDropdown.='</select>';
			
				
			$checked='';
			if (($fieldRow->relationship_id==101)&&($fieldRow->daytour_reference==$daytours_id))
				$checked=' checked ';
			
			$returnData.='<div style="clear:both"><input type="checkbox" name="rel-101-'.$daytours_id.'" '.$checked.'cost="'.$cost.'" class="daytourselection"/>&nbsp;
				'.getRelationships(101).'<span class="pull-right">'.$dayDropdown.'</span></div>';
				$amoutDisplay.='<div class="rel-101-'.$daytours_id.'-display"></div>';
		
		
		foreach ($partnerObject->result() as $row){
			$fieldRow=$this->validatedata($daytours_id, $loginuser,$row->delegate_partner_id);
			$selected='';
				
			$dayDropdown='<select name="date-'.$row->delegate_partner_id.'-'.$daytours_id.'" '.$selected.' class="date-'.$row->delegate_partner_id.'-'.$daytours_id.'" '.$selected.'>';
			foreach($datesArray as $key=>$value){
				$selected='';
				if (($fieldRow->relationship_id==$row->delegate_partner_id)&&($fieldRow->date_refrence==$key)&&($fieldRow->daytour_reference==$daytours_id))
					$selected=' selected ';
				$dayDropdown.='<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
			}
			$dayDropdown.='</select>';
			
				
			$checked='';
			
			if (($fieldRow->relationship_id==$row->delegate_partner_id)&&($fieldRow->daytour_reference==$daytours_id))
				$checked=' checked ';
			
			$returnData.='<div style="clear:both"><input type="checkbox" name="rel-'.$row->delegate_partner_id.'-'.$daytours_id.'" '.$checked.' cost="'.$cost.'" class="daytourselection"/>&nbsp;
				'.getRelationships($row->delagate_partner_rel).'<span class="pull-right">'.$dayDropdown.'</span></div>';
			$amoutDisplay.='<div class="rel-'.$row->delegate_partner_id.'-'.$daytours_id.'-display"></div>';
			
		}
		return array($returnData,$amoutDisplay);
	}
	function update_daytour(){
		
		$delegate_id = $this->app_auth->appUserid();
		 //Pull out Attendees
        foreach($_POST as $key=>$value){
        	if (substr($key,0,3)=="rel"){
        		$keyArray=explode("-", $key);
        		$dateVal="date-".$keyArray[1]."-".$keyArray[2];
        		$dataArray=array(
        			'relationship_id'=>$keyArray[1],
        			'daytour_reference'=>$keyArray[2],
        			'date_refrence'=>$_POST[$dateVal],
        			'delegate_id'=>$delegate_id,
        		);
        		$retValue=$this->checkforUpdation($dataArray);
        		//echo $retValue;
        		if ($retValue==0){
        			$this->db->insert('daytour_registration',$dataArray);
        		}else if($retValue==1){
        			$upArray=array(
						'relationship_id'=>$dataArray['relationship_id'],
						'daytour_reference'=>$dataArray['daytour_reference'],
						'delegate_id'=>$dataArray['delegate_id']
						);
        			$this->db->update('daytour_registration',$dataArray,$upArray);
        		}
        	}
        }
        redirect("/dashboard");
        						
	}
	function checkforUpdation($dataArray){
		$checkObject=$this->db->query('select * from daytour_registration
		where relationship_id='.$dataArray['relationship_id'].' and
		daytour_reference='.$dataArray['daytour_reference'].' and
		delegate_id='.$dataArray['delegate_id']);
		if ($checkObject->num_rows()==0){
			return 0;
		}else{
			return 1;
		}
	}
	function removedata(){
		$objectname=$_POST['objectname'];
		$refArray=explode('-',$objectname);
		$delegate_id = $this->app_auth->appUserid();
		$delArray=array(
			'relationship_id'=>$refArray[1],
			'daytour_reference'=>$refArray[2],
			'delegate_id'=>$delegate_id
		);
		$this->db->delete('daytour_registration',$delArray);
		echo $refArray[1]."-".$refArray[2];
		
	}
	
}