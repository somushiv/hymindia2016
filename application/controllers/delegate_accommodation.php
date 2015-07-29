<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_Accommodation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('app_auth');
        $this->load->library('application_common_libs');

       
        $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }
    }

    public function index() {
		$this->registration();
     
    }

    public function registration(){
    	$data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        $this->load->helper("form");
        $this->load->helper('hymindia');
        $country_mode=hlpcountry_mode($this->app_auth->appUserCountryCode());
        $accommodation_object=$this->db->query('select * from tbl_accomodation where delegate_id='.$data['loginuser']);
        
        if ($accommodation_object->num_rows()){
        	$fieldRow=$accommodation_object->row();
        }else{
        	$fieldRowA = $this->db->list_fields('tbl_accomodation');
        	$fieldRow=array();
        	foreach($fieldRowA as $value){
        		$fieldRow[$value]='';
        	}
        	$fieldRow=(object)$fieldRow;
        	
        }
               
        $accomodation_type_array=accommodation_type();
        $accomodation_type_data='<table class="table" >';
       	foreach ($accomodation_type_array as $key=>$value){
       		if ($key>0){
       			$queryObject=$this->db->query("select * from tbl_accomodation_place 
       					where traffi_type_id={$key} and country_mode={$country_mode} and published=1");
       			$accomodation_type_data.='<tr><th colspan="3">'.$value.'</th></tr>';
       			foreach ($queryObject->result() as $row){
       				$checked='';
       				if ($fieldRow->accomodation_place_id==$row->accomodation_place_id)
       					$checked=" checked ";
       				$accomodation_type_data.='<tr>
       											<td><input type="radio" name="acc" value="'.$row->accomodation_place_id.'" '.$checked.'/></td>
       											<td>'.$row->accomodation_place_name.'</td>
       												<td class="text-right">'.number_format($row->cost_room).'</td>
       												
       											</tr>';
       			}
       		}
       	}
       	$accomodation_type_data.='</table>'.'<input type="hidden" name="accomodation_id" value="'.$fieldRow->accomodation_id.'"/>';
       	$accomodation_dates=accdate();
       	$data['check_in_date_time']=formDateTimeDropDown($accomodation_dates,'check_in_date_time',true,$fieldRow->check_in_date_time);
       	$data['check_out_date_time']=formDateTimeDropDown($accomodation_dates,'check_out_date_time',true,$fieldRow->check_out_date_time);
       	$this->template->add_js('
       		$(document).ready(function () {
       			$("#check_in_date_time_hours").val("14");
       			$("#check_out_date_time_hours").val("11");
       			//$("#check_in_date_time_hours").prop("disabled",true);
       			//$("#check_out_date_time_hours").prop("disabled",true);
       			
       			//$("#check_in_date_time_minutes").prop("disabled",true);
       			//$("#check_out_date_time_minutes").prop("disabled",true);
       			
       		});
       	','embed',false,true);
       	
       	$data['accomodation_type_data']=$accomodation_type_data;
       	 $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
       	 $this->template->add_js('
       	 	$(document).ready(function () {
       	 		$("#delegates_check_out").datetimepicker();
       	 		$("#delegates_check_in").datetimepicker();
       	 	});
       	 ', "embed", FALSE, TRUE);
       	$this->template->write_view('content','delegate_accommodation_view',$data);
       	$this->template->render();
               
    }
   function update(){
    
   	$check_in_date_time=date("Y-m-d  H:i:s",strtotime($_POST['check_in_date_time'].' '.$_POST['check_in_date_time_hours'].':'.$_POST['check_in_date_time_minutes'].':00'));
   	$check_out_date_time=date("Y-m-d  H:i:s",strtotime($_POST['check_out_date_time'].' '.$_POST['check_out_date_time_hours'].':'.$_POST['check_out_date_time_minutes'].':00'));
   	$num_days = (strtotime($_POST['check_out_date_time']) - strtotime($_POST['check_in_date_time'])) / (60 * 60 * 24);
   	$data = array(
   		'accomodation_place_id'=>$_POST['acc'],
   		'check_in_date_time'=>$check_in_date_time,
   		'check_out_date_time'=>$check_out_date_time,
   		'additional_requests'=>$_POST['additional_requests'],
   		'delegate_id'=>$this->app_auth->appUserid(),
   		'num_days'=>$num_days,
   		
   	);
   	if ($_POST['accomodation_id']>0){
   		$this->db->where('accomodation_id',$_POST['accomodation_id']);
   		$this->db->update('tbl_accomodation',$data);
   		redirect('/dashboard');
   	}else{
   		$this->db->insert('tbl_accomodation',$data);
   		redirect('/delegate_tours');
   	}
   	
   	
   }
   

}
