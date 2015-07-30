<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_Tours extends CI_Controller {

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
       /* $this->load->helper("form");
        $this->load->helper('hymindia');

        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();

        $country_code = $this->delegate_registration_model->getCountryCode($data['loginuser']);
        
        $data['tour_details'] = $this->delegate_registration_model->getTravelBookedDetails($data['loginuser']);
        
        $delegates_mode = 1;
        if ($country_code == 'IN') {
            $delegates_mode = 1;
        }

        $data['tour_places'] = getTourPlaces($delegates_mode);
        $data['tour_packages'] = getTourPackages();
        $data['total_members'] = getTourMembers();

        $this->template->add_css('css/bootstrap-datetimepicker.min.css');
        $this->template->add_js('js/bootstrap-datetimepicker.min.js', "import", FALSE, TRUE);
        $this->template->add_js('js/trasporation.js', "import", FALSE, TRUE);

        $this->template->write_view("content", "delegate_tours_view", $data);
        $this->template->render(); */
    	$this->tour_registration();
    }
    
    public function tour_registration(){
    	$data['profile'] = $this->application_common_libs->delegate_profile_display();
        $data['loginuser'] = $this->app_auth->appUserid();
        $this->load->helper("form");
        $this->load->helper('hymindia');
        $country_mode=hlpcountry_mode($this->app_auth->appUserCountryCode());
        
     
        $tour_type_array=tour_type();
        $tour_type_data='';
        $tour_dates=accdate();
        
        
       	foreach ($tour_type_array as $key=>$value){
       		if ($key>0){
       			//Edit Validation
       			$fieldRow=$this->viewValidate($data['loginuser'],$key);
       			$checked='';
       			//if (!empty($fieldRow->tour_mode))
       				$checked=' checked ';
       			
       			
       			$queryObject=$this->db->query("select * from tbl_tours_places 
       					where tours_is_pre_post={$key} and country_mode={$country_mode} and published=1");
       			$dateDropDown=formDateTimeDropDown($tour_dates,'tour_'.$key,false);
       			$checkbox="<input type='checkbox' id='tour_".$key."' name='tour_".$key."' value='1' {$checked} class='hideme'/>";
       			$tour_type_data.='<div class="" style="clear:both"><div class="alert alert-info" style="margin:0px 0px;">'.$checkbox.'&nbsp;'.$value.' Tour</div>
       				
       				<table class="table table-bordered tourtable" border="0" id="tourmode_'.$key.'">
       				<tr class="active"><th>Places</th><th>Date</th><th colspan="2">Single</th><th colspan="2">Double</th></tr>';
       			foreach ($queryObject->result() as $row){
       				
       				$checked1='';$checked2='';
       			if (!empty($fieldRow->tour_mode)){
       				
       				
       				if (($fieldRow->tour_places_id==$row->tours_places_id)&&($fieldRow->couple_mode==1))
       					$checked1=' checked ';
       				if (($fieldRow->tour_places_id==$row->tours_places_id)&&($fieldRow->couple_mode==2))
       					$checked2=' checked ';
       			}
       				$toura_places=$row->tours_places.'&nbsp;<a href="'.$row->place_link.'" class="pull-right" 
       				target="_blank"> Click to Know More </a>';
       				
       				$tour_type_data.='<tr>
       											
       											<td>'.$toura_places.'</td>
       											<td>'.$row->tours_date.'</td>
       												<td class="text-right">'.number_format($row->cost_per_head).'</td>
       												<td class="text-center"><input type="radio" name="tour_place_'.$key.'" value="'.$row->tours_places_id.'-1" '.$checked1.'/></td>
       												
       												<td class="text-right">'.number_format($row->cost_per_couple).'</td>
       												<td class="text-center"><input type="radio" name="tour_place_'.$key.'" value="'.$row->tours_places_id.'-2" '.$checked2.'/></td>
       												
       											</tr>';
       			}
       			$tour_type_data.='</table>';
       		}
       	}
       	
       
       	$data['tour_type_data']=$tour_type_data;
       	$this->template->add_js("/js/tours_registration.js","import",false,true);
       	$this->template->write_view('content','delegate_tours_view',$data);
       	$this->template->render();
    }
    public function  viewValidate($delegate_id=0,$tour_mode=0){
    $daytour_object=$this->db->query('select * from tbl_tour_registration 
    			where delegate_id='.$delegate_id.' and tour_mode='.$tour_mode);
        
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
    public function process_form() {
    	
        $data['loginuser'] = $this->app_auth->appUserid();
        // Read all inputs.
        $redirectmode=0;
        if (isset($_POST['tour_1'])){
        	
        	$tourdata_array=explode("-",$_POST['tour_place_1']);
        	 $data_arr = array(
            'delegate_id' =>  $this->app_auth->appUserid(),
            'tour_mode' => 1,
            'couple_mode' => $tourdata_array[1],
            'tour_date' => $_POST['tour_1'],
        	 'tour_places_id'=>$tourdata_array[0]
        );
        $queryArray=array(
        	'tour_mode'=>1,
        	'delegate_id'=>$data_arr['delegate_id']        	
        );
        $queryObject=$this->db->query('select * from tbl_tour_registration where
        	tour_mode=1 and
        	delegate_id='.$queryArray['delegate_id']);
        if ($queryObject->num_rows()==0){
        	$this->db->insert('tbl_tour_registration',$data_arr);
        }else{
        	$this->db->update('tbl_tour_registration',$data_arr,$queryArray);
        	$redirectmode=1;
        }
        
        
        }
       if (isset($_POST['tour_2'])){
        	$tourdata_array=explode("-",$_POST['tour_place_2']);
        	 $data_arr = array(
            'delegate_id' =>  $this->app_auth->appUserid(),
            'tour_mode' => 2,
            'couple_mode' => $tourdata_array[1],
            'tour_date' => $_POST['tour_2'],
        	  'tour_places_id'=>$tourdata_array[0]
        );
       $queryArray=array(
        	'tour_mode'=>2,
        	'delegate_id'=>$data_arr['delegate_id']        	
        );
        $queryObject=$this->db->query('select * from tbl_tour_registration where
        	tour_mode=2 and
        	delegate_id='.$queryArray['delegate_id']);
        if ($queryObject->num_rows()==0){
        	$this->db->insert('tbl_tour_registration',$data_arr);
        }else{
        	$this->db->update('tbl_tour_registration',$data_arr,$queryArray);
        	$redirectmode=1;
        }
        
        }
        if ($redirectmode==1){
        	 redirect("/dashboard");
        }else{
        	 redirect("/delegate_transporation/registration");
        }
      

    }

}
