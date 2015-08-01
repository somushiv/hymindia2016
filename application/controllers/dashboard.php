<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('app_auth');
        $this->load->library('application_common_libs');
        $this->load->helper('hymindia');


        $this->load->database();
        $this->load->model('delegate_registration_model');

        $is_user_logged_in = $this->app_auth->appUserid();
        if (!$is_user_logged_in) {
            redirect(base_url());
        }
    }

    public function index() {

        $this->dashboardview();
    }

    public function dashboardview($mailmode=0) {


        
        $delegate_id= $this->app_auth->appUserid();     
        $data['country_code'] = $this->app_auth->appUserCountryCode();
		$country_code=hlpcountry_mode($data['country_code']);
        if (hlpcountry_mode($data['country_code'])==2){
        	redirect("/dashboard/dashboardview2");
        }
        	
       
        // Get Partners Details.
        $partner_object=$this->db->query("select * from tbl_delegate_partner where delegate_id={$delegate_id}");
        $number_partners=$partner_object->num_rows();
        $partner_details='';
        if ($partner_object->num_rows()>0){
        	$i=1;
        	foreach ($partner_object->result() as $row){
        		$Relationships=getRelationships($row->delagate_partner_rel);
        		$partner_details.="<tr>
        				<td>{$i}</td>
        				<td>{$row->delegate_partner_name}</td>
        				<td>{$Relationships}</td>
        			</tr>";
        		$i++;
        	}	
         
        	
        }
        $data['partner_details'] = $partner_details;
        //Get Event Registration
        $event_registration="";
        $registration_object=$this->db->query("select * from tbl_delegates_event_registration a 
        									join  tbl_packages_details b
        									on a.package_id=b.packages_details_id
        									where a.delegate_id={$delegate_id} and a.status=0 order by a.package_id");
        $titleDisplay='';
        $i=0;
        $total=0;
        $payment_event_registration=array();
        $paymentArray=array();
        foreach ($registration_object->result() as $row){
        	
        	//Releationship
        	$displayText="";
        	$j='';
        	$clearline=" style='  border-top: 0px; ' ";
        	if ($titleDisplay!=$row->package_id){
        		$displayText="<div class='callout-btndropdown-dependency'><h4>{$row->packages_title}</h4>
        			<p class='bs-callout bs-callout-danger'>{$row->packages_description}</p>";
        		$titleDisplay=$row->package_id;
        		$clearline=" style='  border-bottom: 0px; ' ";
        		$i++;
        		$j=$i;
        	}
        	$delegate_mode_text='';
        	if ($row->delegate_numbers>0){
        	$cost=number_format($row->packages_cost_s);
        	$package_cost=event_cost_calc($row->delegate_numbers,array($row->packages_cost_s,$row->packages_cost_d));
        	$package_cost1=number_format($package_cost,2);
        	$costdisplay01=number_format($row->packages_cost_s,2).' (S) <br/>'.number_format(fun_cost_double($row->packages_cost_s,$row->packages_cost_d),2).' (C) ';
        	$event_registration.="<tr>
        		<td {$clearline}>{$j}</td>
        		<td {$clearline}>
        			{$displayText}
        		</td>
        		<td {$clearline} class='text-center'>{$row->delegate_numbers}</td>
        		
        		<td {$clearline} class='text-right'>{$costdisplay01}</td>
        		<td class='text-right' {$clearline}>{$package_cost1}</td>
        	</tr>";
        			$total=$total+$package_cost;
        			$payment_event_registration[]=array($row->delegate_event_regid,$row->packages_details_id,$package_cost,$row->payment_status);
        	}
        }
        $payment_accomodation=array();
        $paymentArray['event_registration']=$total;
        $data['event_registration_total']=$total;
        $data['event_registration']=$event_registration;
        // Get Accomodation Details
       $acc_details='';
        $acc_object=$this->db->query("select * from tbl_accomodation a join tbl_accomodation_place b on
        	a.accomodation_place_id=b.accomodation_place_id and b.country_mode={$country_code} and a.delegate_id={$delegate_id}
        	and a.status=0");
        $i=1;
        $acc_cost_total=0;
        foreach ($acc_object->result() as $row){
        	$acc_details.='<tr>';
        	$acc_details.='<td>'.$i.'</td>';
        	$acc_details.='<td>'.$row->accomodation_place_name.'</td>';
        	$accomodation_type=accommodation_type($row->traffi_type_id);
        	$acc_details.='<td>'.$accomodation_type.'</td>';
        	$acc_details.='<td class="text-right">'.number_format($row->cost_room).'</td>';
        	$stay_cost=$row->cost_room*$row->num_days;
        	$acc_details.='<td class="text-center">'.$row->num_days.'</td>';
        	$acc_details.='<td class="text-right">'.number_format($stay_cost).'</td>';
        	$acc_details.='</tr>';
        	$acc_cost_total=$acc_cost_total+$stay_cost;
        }
         $data['acc_details'] =$acc_details;
         $data['acc_cost_total'] =$acc_cost_total;
         $paymentArray['acc_cost_total']=$acc_cost_total;
          $payment_accomodation[]=array($row->accomodation_id,$row->traffi_type_id,$stay_cost,$row->payment_status,$row->num_days);
        // Geet Tour Details
        $tour_details='';
        $tour_object=$this->db->query('select * from tbl_tour_registration a join tbl_tours_places b
        								on a.tour_places_id=b.tours_places_id and country_mode='.$country_code.' 
        								and a.delegate_id='.$delegate_id.' and status=0');
        $i=1;
        $tour_total_cost=0;
        $payment_tour=array();
        foreach($tour_object->result() as $row){
        	$tour_details.='<tr>';
        	$tour_details.='<td>'.$i.'</td>';
        	$tour_mode=tour_type($row->tour_mode);
        	
        	$tour_details.='<td>'.$row->tours_places.'( '.$tour_mode.' Event) Dated: '.$row->tours_date.'</td>';
        	$couple_mode=accommodation_type($row->couple_mode);
        	$tour_details.='<td >'.$couple_mode.'</td>';
        	$cost='';
        	if ($row->couple_mode==1){
        		$cost=$row->cost_per_head;
        	}else{
        		$cost=$row->cost_per_couple;
        	}
        	$tour_details.='<td class="text-right">'.number_format($cost).'</td>';
        	$tour_details.='</tr>';
        	$i++;
        	$tour_total_cost=$tour_total_cost+$cost;
        	$payment_tour[]=array($row->delegate_tour_id,$row->tours_places_id,$cost,$row->payment_status,$row->couple_mode);
        }
        $data['tour_details'] = $tour_details;
        $data['tour_total_cost']=$tour_total_cost;
        
         $paymentArray['tour_total_cost']=$tour_total_cost;
        
        // Get transportation Details.
        $day_trip='';
        $daytourObject=$this->db->query("select * from daytours_packages where country_mode={$country_code} and published=1");
        $i=1;
        $daytourTotalCost=0;
        $payment_daytour=array();
        foreach ($daytourObject->result() as $rowtour){
        	
        	$tourPackageRegistrationObject=$this->db->query('select * from daytour_registration 
        			where delegate_id='.$delegate_id.' and daytour_reference='.$rowtour->daytours_id.' and status=0');
		if ($tourPackageRegistrationObject->num_rows()>0){
		$unitCost=0;
		$day_trip.='<tr>';
        	$day_trip.='<td>'.$i.'</td>';
        	$day_trip.='<td>'.$rowtour->tour_name.'</td>';
        	$packageDisplay="<ul>";
        	
        	foreach($tourPackageRegistrationObject->result() as $row){
        		if ($row->relationship_id==101){
        			$packageDisplay.="<li>".getRelationships(101)." <strong> Dated: </strong>".daytourdates($row->date_refrence)."</li>";
        			$unitCost=$unitCost+$rowtour->tour_cost;
        			$payment_daytour[]=array($row->daytour_registration_id,$rowtour->daytours_id,$rowtour->tour_cost,$row->payment_status,$row->relationship_id);
        		}else{
        		$partnerObject=$this->db->query('select * from tbl_delegate_partner where delegate_partner_id='.$row->relationship_id);
        		$partnerRow=$partnerObject->row();
        		$packageDisplay.="<li>".getRelationships($partnerRow->delagate_partner_rel)." <strong> Dated: </strong>".daytourdates($row->date_refrence)."</li>";
        		$unitCost=$unitCost+$rowtour->tour_cost;
        		$payment_daytour[]=array($row->daytour_registration_id,$rowtour->daytours_id,$rowtour->tour_cost,$row->payment_status,$row->relationship_id);
        		}
        	}
        	$packageDisplay.="</ul>";
        	$day_trip.='<td>'.$packageDisplay.'</td>';
        	$day_trip.='<td>'.number_format($unitCost).'</td>';
        	$daytourTotalCost=$daytourTotalCost+$unitCost;
        	$day_trip.='</tr>';
		$i++;
		}
        }
        $data['day_trip'] = $day_trip;
        $data['daytourTotalCost'] = $daytourTotalCost;
        $paymentArray['daytourTotalCost']=$daytourTotalCost;
        
        //Transport details
        //Check for Number of people regestred in 
        $payment_transport=array();
		$data['trans_details']='';
		 $trans_details='';
        $tour_object=$this->db->query('select * from tbl_transporation where delegate_id='.$delegate_id.' order by transporation_stage');
        $pickCost=0;$dropCost=0;
        $totCost=0;
        foreach ($tour_object->result() as $row){
        	
        	if ($row->transporation_stage==1){
        		if ($row->transporation_mode>0){
        		$pickCost=(transportionprice($row->transporation_mode));
        		$trans_details.='<tr><th colspan="2">Pickup For '.getRelationships($row->relationship).'</th></tr>';
        		$trans_details.='<tr><td><ul>';
        		$trans_details.='<li>Relationship : '.getRelationships($row->relationship).'</li>';
        		$trans_details.='<li>Coming In : '.getTransporationModes($row->transporation_mode).'</li>';
        		$trans_details.='<li>Coming From : '.$row->arrival_departure_from.'</li>';
        		$trans_details.='<li>Coming On : '.$row->transporation_datetime.'</li>';
        		$trans_details.='<li>Number : '.$row->refrence_number.'</li>';
        		$trans_details.='<li>Notes : '.$row->additional_requests.'</li>';
        		$trans_details.='</ul></td>';
        		$trans_details.='<td>'.$pickCost.'</td></tr>';
        		$totCost=$totCost+$pickCost;
        		$payment_transport[]=array($row->transporation_id,$row->transporation_mode,$pickCost,$row->payment_status,$row->relationship,$row->transporation_stage);
        		}
        	}
        	if ($row->transporation_stage==2){
        		if ($row->transporation_mode>0){
        		$dropCost=(transportionprice($row->transporation_mode));
        		$trans_details.='<tr><th colspan="2">Drop For '.getRelationships($row->relationship).'</th></tr>';
        		$trans_details.='<tr><td><ul>';
        		$trans_details.='<li>Relationship : '.getRelationships($row->relationship).'</li>';
        		$trans_details.='<li>Leaving In : '.getTransporationModes($row->transporation_mode).'</li>';
        		$trans_details.='<li>Leaving to : '.$row->arrival_departure_from.'</li>';
        		$trans_details.='<li>Leaving Date : '.$row->transporation_datetime.'</li>';
        		$trans_details.='<li>Number : '.$row->refrence_number.'</li>';
        		$trans_details.='<li>Notes : '.$row->additional_requests.'</li>';
        		$trans_details.='</ul></td>';
        		$trans_details.='<td>'.$dropCost.'</td></tr>';
        		$totCost=$totCost+$dropCost;
        		$payment_transport[]=array($row->transporation_id,$row->transporation_mode,$pickCost,$row->payment_status,$row->relationship,$row->transporation_stage);
        		}
        	}
        	
        }
        $data['trans_details']= $trans_details;
         $data['trans_totalcost']= $totCost;
		$paymentArray['trans_details']=$data['trans_totalcost'];
		$finalTotal=0;
		foreach($paymentArray as $value){
			$finalTotal=$finalTotal+$value;
		}
		$data['finalTotal']=$finalTotal;
		$payment_reference_array=array(
			$payment_event_registration,
			$payment_accomodation,
			$payment_tour,
			$payment_daytour,
			$payment_transport
		);
		$this->session->set_userdata('payment_reference_array',$payment_reference_array);
		$this->session->set_userdata('payment_cost',$paymentArray);
        $data['loginuser'] = $this->app_auth->appUserid();
        $data['mailmode']=$mailmode;
        if ($mailmode==0){
        	$data['profile'] = $this->application_common_libs->delegate_profile_display(payment_panel($paymentArray));
        	//$data['payment_panel']=payment_panel($paymentArray);
        	$data['pagenavigation']=pagenavigation();
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "dashboard", $data);
        $this->template->render();
        }else{
        	$maildata=$this->load->view( "dashboard", $data,true);
        	
        	$this->sendregistrationmail($maildata, $delegate_id);
        }
    }
function sendregistrationmail($maildata, $delegate_id) {
        $queryObject = $this->db->query("select a.*,b.* from tbl_delegates a join tbl_delegates_title b
											on a.delegates_title=b.title_id where a.delegates_id={$delegate_id}");
        $queryRow = $queryObject->row();

        $data['fullname'] = $queryRow->title_value . ' ' . $queryRow->delegates_firstname . ' ' . $queryRow->delegates_surname;
        $data['loginid'] = $queryRow->delegates_emailid;
        //$data['password'] = $passwordGenerated;
        $data['hymindiaid'] = $queryRow->delegates_hymcode;

        $email_body = $maildata;

        $this->load->library('email_lib');
        $emailArray = array(
            'fromid' => $this->config->item('admin_emailid'),
            'toids' => $queryRow->delegates_emailid,
            'body' => $email_body,
            'subject' => "HYM-India, 2016. Registration Mail " . date('m/d/Y')
        );
        $retValue = $this->email_lib->sendEmail($emailArray);
        if ($retValue) {
           redirect("/dashboard");
        }
    }
    
    /*
     *  ******************************* Internatioal Delegates
     */
 public function dashboardview2($mailmode=0) {


        $data['profile'] = $this->application_common_libs->delegate_profile_display();
        $delegate_id= $this->app_auth->appUserid();     
        $data['country_code'] = $this->app_auth->appUserCountryCode();
        $country_code=hlpcountry_mode($data['country_code']);
 if (hlpcountry_mode($data['country_code'])==1){
        	redirect("/dashboard/dashboardview");
        }
        // Get Partners Details.
        $partner_object=$this->db->query("select * from tbl_delegate_partner where delegate_id={$delegate_id}");
        $partner_details='';
        if ($partner_object->num_rows()>0){
        	$i=1;
        	foreach ($partner_object->result() as $row){
        		$Relationships=getRelationships($row->delagate_partner_rel);
        		$partner_details.="<tr>
        				<td>{$i}</td>
        				<td>{$row->delegate_partner_name}</td>
        				<td>{$Relationships}</td>
        			</tr>";
        		$i++;
        	}	
         
        	
        }
        $data['partner_details'] = $partner_details;
        //Get Event Registration
        $event_registration="";
        $registration_object=$this->db->query("select * from tbl_delegates_event_registration a 
        									join  tbl_packages_details b
        									on a.package_id=b.packages_details_id
        									where a.delegate_id={$delegate_id} order by a.package_id");
        $titleDisplay='';
        $i=0;
        $total=0;
        $paymentArray=array();
        $attedeeArray=array(0=>'Select',1=>'Single',2=>'Couple');
        foreach ($registration_object->result() as $row){
        	//Releationship
        	$displayText="";
        	$j='';
        	$clearline=" style='  border-top: 0px; ' ";
        	if ($titleDisplay!=$row->package_id){
        		$displayText="<div class='callout-btndropdown-dependency'><h4>{$row->packages_title}</h4>
        			<p class='bs-callout bs-callout-danger'>{$row->packages_description}</p>";
        		$titleDisplay=$row->package_id;
        		$clearline=" style='  border-bottom: 0px; ' ";
        		$i++;
        		$j=$i;
        	}
        	$delegate_mode_text='';
        	
        	if ($row->delegate_numbers>0){
        	$delegate_mode_text=$attedeeArray[$row->delegate_numbers];
        	$cost=number_format($row->packages_cost_s);
        	$cost_t=number_format($row->packages_cost_s*$row->delegate_numbers,2);
        	$event_registration.="<tr>
        		<td {$clearline}>{$j}</td>
        		<td {$clearline}>
        			{$displayText}
        		</td>
        		
        		
        		<td {$clearline}>{$delegate_mode_text}</td>
        		<td class='text-right' {$clearline}>{$cost}</td>
        		<td class='text-right' {$clearline}>{$cost_t}</td>
        	</tr>";
        			$total=$total+$row->packages_cost_s*$row->delegate_numbers;
        	}
        			
        }
        
        $paymentArray['event_registration']=$total;
        $data['event_registration_total']=$total;
        $data['event_registration']=$event_registration;
        // Get Accomodation Details
       $acc_details='';
        $acc_object=$this->db->query("select * from tbl_accomodation a join tbl_accomodation_place b on
        	a.accomodation_place_id=b.accomodation_place_id and b.country_mode={$country_code} and a.delegate_id={$delegate_id}");
        $i=1;
        
        $acc_cost_total=0;
        foreach ($acc_object->result() as $row){
        	$acc_details.='<tr>';
        	$acc_details.='<td>'.$i.'</td>';
        	$acc_details.='<td>'.$row->accomodation_place_name.'</td>';
        	$accomodation_type=accommodation_type($row->traffi_type_id);
        	$acc_details.='<td>'.$accomodation_type.'</td>';
        	$acc_details.='<td class="text-right">'.number_format($row->cost_room).'</td>';
        	$stay_cost=$row->cost_room*$row->num_days;
        	$acc_details.='<td class="text-center">'.$row->num_days.'</td>';
        	$acc_details.='<td class="text-right">'.number_format($stay_cost).'</td>';
        	$acc_details.='</tr>';
        	$acc_cost_total=$acc_cost_total+$stay_cost;
        }
         $data['acc_details'] =$acc_details;
         $data['acc_cost_total'] =$acc_cost_total;
         $paymentArray['acc_cost_total']=$acc_cost_total;
        // Geet Tour Details
        $tour_details='';
        $tour_object=$this->db->query('select * from tbl_tour_registration a join tbl_tours_places b
        								on a.tour_places_id=b.tours_places_id and b.country_mode='.$country_code.' and a.delegate_id='.$delegate_id);
        $i=1;
        $tour_total_cost=0;
        foreach($tour_object->result() as $row){
        	$tour_details.='<tr>';
        	$tour_details.='<td>'.$i.'</td>';
        	$tour_mode=tour_type($row->tour_mode);
        	
        	$tour_details.='<td>'.$row->tours_places.'( '.$tour_mode.' Event) Dated: '.$row->tours_date.'</td>';
        	$couple_mode=accommodation_type($row->couple_mode);
        	$tour_details.='<td >'.$couple_mode.'</td>';
        	$cost='';
        	if ($row->couple_mode==1){
        		$cost=$row->cost_per_head;
        	}else{
        		$cost=$row->cost_per_couple;
        	}
        	$tour_details.='<td class="text-right">'.number_format($cost).'</td>';
        	$tour_details.='</tr>';
        	$i++;
        	$tour_total_cost=$tour_total_cost+$cost;
        }
        $data['tour_details'] = $tour_details;
        $data['tour_total_cost']=$tour_total_cost;
        
         $paymentArray['tour_total_cost']=$tour_total_cost;
        
        // Day Tours
        $day_trip='';
        $daytourObject=$this->db->query("select * from daytours_packages where country_mode={$country_code} and published=1");
        $i=1;
        $daytourTotalCost=0;
       
        foreach ($daytourObject->result() as $rowtour){
        	
        	$tourPackageRegistrationObject=$this->db->query('select * from daytour_registration 
        			where delegate_id='.$delegate_id.' and daytour_reference='.$rowtour->daytours_id);
		if ($tourPackageRegistrationObject->num_rows()>0){
		$day_trip.='<tr>';
        	$day_trip.='<td>'.$i.'</td>';
        	$day_trip.='<td>'.$rowtour->tour_name.'</td>';
        	$packageDisplay="<ul>";
        	$unitCost=0;
        	foreach($tourPackageRegistrationObject->result() as $row){
        		if ($row->relationship_id==101){
        			$packageDisplay.="<li>".getRelationships(101)." <strong> Dated: </strong>".daytourdates($row->date_refrence)."</li>";
        		}else{
        		$partnerObject=$this->db->query('select * from tbl_delegate_partner where delegate_partner_id='.$row->relationship_id);
        		$partnerRow=$partnerObject->row();
        		
        		$packageDisplay.="<li>".getRelationships($partnerRow->delagate_partner_rel)." <strong> Dated: </strong>".daytourdates($row->date_refrence)."</li>";
        		}
        		$unitCost=$unitCost+$rowtour->tour_cost;
        	}
        	$packageDisplay.="</ul>";
        	$day_trip.='<td>'.$packageDisplay.'</td>';
        	$day_trip.='<td>'.number_format($unitCost).'</td>';
        	$daytourTotalCost=$daytourTotalCost+$unitCost;
        	$day_trip.='</tr>';
        	$i++;
		}
        }
        $data['day_trip'] = $day_trip;
        $data['daytourTotalCost'] = $daytourTotalCost;
        $paymentArray['daytourTotalCost']=$daytourTotalCost;
       
        //Transport details
		$data['trans_details']='';
		 $trans_details='';
        $tour_object=$this->db->query('select * from tbl_transporation where delegate_id='.$delegate_id.' order by transporation_stage');
        $pickCost=0;$dropCost=0;
        $totCost=0;
        foreach ($tour_object->result() as $row){
        	
        	if ($row->transporation_stage==1){
        		if ($row->transporation_mode>0){
        		$pickCost=(transportionprice($row->transporation_mode));
        		$trans_details.='<tr><th colspan="2">Pickup For '.getRelationships($row->relationship).'</th></tr>';
        		$trans_details.='<tr><td><ul>';
        		$trans_details.='<li>Relationship : '.getRelationships($row->relationship).'</li>';
        		$trans_details.='<li>Coming In : '.getTransporationModes($row->transporation_mode).'</li>';
        		$trans_details.='<li>Coming From : '.$row->arrival_departure_from.'</li>';
        		$trans_details.='<li>Coming On : '.$row->transporation_datetime.'</li>';
        		$trans_details.='<li>Number : '.$row->refrence_number.'</li>';
        		$trans_details.='<li>Notes : '.$row->additional_requests.'</li>';
        		$trans_details.='</ul></td>';
        		$trans_details.='<td>'.$pickCost.'</td></tr>';
        		$totCost=$totCost+$pickCost;
        		}
        	}
        	if ($row->transporation_stage==2){
        		if ($row->transporation_mode>0){
        		$dropCost=(transportionprice($row->transporation_mode));
        		$trans_details.='<tr><th colspan="2">Drop For '.getRelationships($row->relationship).'</th></tr>';
        		$trans_details.='<tr><td><ul>';
        		$trans_details.='<li>Relationship : '.getRelationships($row->relationship).'</li>';
        		$trans_details.='<li>Leaving In : '.getTransporationModes($row->transporation_mode).'</li>';
        		$trans_details.='<li>Leaving to : '.$row->arrival_departure_from.'</li>';
        		$trans_details.='<li>Leaving Date : '.$row->transporation_datetime.'</li>';
        		$trans_details.='<li>Number : '.$row->refrence_number.'</li>';
        		$trans_details.='<li>Notes : '.$row->additional_requests.'</li>';
        		$trans_details.='</ul></td>';
        		$trans_details.='<td>'.$dropCost.'</td></tr>';
        		$totCost=$totCost+$dropCost;
        		}
        	}
        	
        }
        $data['trans_details']= $trans_details;
         $data['trans_totalcost']= $totCost;
		$paymentArray['trans_details']=$data['trans_totalcost'];
		$finalTotal=0;
		foreach($paymentArray as $value){
			$finalTotal=$finalTotal+$value;
		}
		$data['finalTotal']=$finalTotal;
         $data['trans_totalcost']= $pickCost+$dropCost;
		$paymentArray['trans_details']=$data['trans_totalcost'];
		$this->session->set_userdata('payment_cost',$paymentArray);
        $data['loginuser'] = $this->app_auth->appUserid();
        

	$data['mailmode']=$mailmode;
        if ($mailmode==0){
        $this->template->add_css('/css/font-awesome.min.css');
        $this->template->write_view("content", "dashboard", $data);
        $this->template->render();
        }else{
        	$maildata=$this->load->view( "dashboard", $data,true);
        	$this->sendregistrationmail($maildata, $delegate_id);
        }

    }
    function checknumber(){
    	$this->load->library("application_common_libs");
    	$test=$this->application_common_libs->generate_hym_id("IN");
    	echo $test;
    }
    
	function testpaylib(){
		$this->load->library("lib_payment");
		$r=$this->lib_payment->process_list(0);
		print_r($r);
	}
}
