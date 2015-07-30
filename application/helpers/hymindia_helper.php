<?php

if (!function_exists('getTransporationModes')) {

    function getTransporationModes($mode_id = NULL) {

        $options = array(
            0 => '--Select--',
            1 => 'Train',
            2 => 'Flight',
            3 => 'Road',
        );

        if (isset($mode_id)) {
            return $options[$mode_id];
        }

        return $options;
    }

}

if (!function_exists('getTransporationDropDown')) {

    function getTransporationDropDown($selected=0,$dropname='nothing') {
		
    	$transporationModes=getTransporationModes();
    	$returnOption='';
    	$returnOption.='<select name="'.$dropname.'">';
    	foreach($transporationModes as $key=>$value){
    		$selectedtext='';
    		if ($selected==$key)
    			$selectedtext=' selected ';
    		$returnOption.='<option value="'.$key.'" '.$selectedtext.'>'.$value.'</option>';	
    	}
    	$returnOption.='</select>';
       

        return $returnOption;
    }

}

if (!function_exists('getAccPlalces')) {

    function getAccPlalces($del_mode) {
        if ($del_mode == 1) {
            $place_ind = '<select name="delegates_aplace" class="form-control">
                                <option value="select" selected="true"> --Select-- </option>
                                <option disabled="true" value="select">Single Tarrif</option>
                                <option value="1">&nbsp;&nbsp;Taj West End</option>
                                <option value="2">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="3">&nbsp;&nbsp;Gold Flinch</option>
                                <option disabled="true" value="select">Double Tarrif</option>
                                <option value="4">&nbsp;&nbsp;Taj West End</option>
                                <option value="5">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="6">&nbsp;&nbsp;Gold Flinch</option>
                            </select>';
            return $place_ind;
        } else {
            $place_other = '<select name="delegates_aplace" class="form-control">
                                <option value="select" selected="true"> --Select-- </option>
                                <option disabled="true" value="select">Single Tarrif</option>
                                <option value="7">&nbsp;&nbsp;Taj West End</option>
                                <option value="8">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="9">&nbsp;&nbsp;Gold Flinch</option>
                                <option disabled="true" value="select">Double Tarrif</option>
                                <option value="10">&nbsp;&nbsp;Taj West End</option>
                                <option value="11">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="12">&nbsp;&nbsp;Gold Flinch</option>
                            </select>';
            return $place_other;
        }
    }

}

if (!function_exists('getTourPlaces')) {

    function getTourPlaces($del_mode) {
        if ($del_mode == 1) {
            $place_ind = '<select name="delegates_tplace" class="form-control tour-places">
                                <option value="select" selected="true"> --Select-- </option>
                                <option disabled="true" value="select">Pre Tours</option>
                                <option value="1">&nbsp;&nbsp;Golden Triangle</option>
                                <option value="2">&nbsp;&nbsp;Madhya Pradesh</option>
                                <option value="3">&nbsp;&nbsp;Goa</option>
                                <option value="4">&nbsp;&nbsp;Andaman</option>
                                <option disabled="true" value="select">Post Tours</option>
                                <option value="5">&nbsp;&nbsp;Karnataka</option>
                                <option value="6">&nbsp;&nbsp;Kerala</option>
                                <option value="7">&nbsp;&nbsp;Taj Safaries</option>
                                <option value="8">&nbsp;&nbsp;Golden Charriot</option>
                            </select>';
            return $place_ind;
        } else {
            $place_other = '<select name="delegates_tplace" class="form-control tour-places">
                                <option value="select" selected="true"> --Select-- </option>
                                <option disabled="true" value="select">Single Tarrif</option>
                                <option value="7">&nbsp;&nbsp;Taj West End</option>
                                <option value="8">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="9">&nbsp;&nbsp;Gold Flinch</option>
                                <option disabled="true" value="select">Double Tarrif</option>
                                <option value="10">&nbsp;&nbsp;Taj West End</option>
                                <option value="11">&nbsp;&nbsp;Taj Yesh</option>
                                <option value="12">&nbsp;&nbsp;Gold Flinch</option>
                            </select>';
            return $place_other;
        }
    }

}


if (!function_exists('getTourPackages')) {

    function getTourPackages($mode_id = NULL) {

        $options = array(
            0 => '--Select--',
            1 => 'Couple',
            2 => 'Other',
        );

        if (isset($mode_id)) {
            return $options[$mode_id];
        }

        return $options;
    }

}

if (!function_exists('getTotalMembers')) {

    function getTourMembers() {

        $options = array(
            0 => '--Select--',
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
        );

        return $options;
    }

}


if (!function_exists('getCurrencyFormat')) {

    function getCurrencyFormat($val, $country_code) {
        if ($country_code == "IN") {
            setlocale(LC_MONETARY, "en_IN");
        } else {
            setlocale(LC_MONETARY, 'en_US');
        }
        return money_format("%i", $val);
    }

}

if (!function_exists('get_country_name')) {

    function getCountryByCode($countryCode) {

        $options = array(
            'US' => 'United States',
            'AF' => 'Afghanistan',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua And Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia And Herzegowina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic Of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'Ivoire',
            'HR' => 'Croatia (Local Name: Hrvatska)',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'TP' => 'East Timor',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'FX' => 'France, Metropolitan',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard And Mc Donald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran (Islamic Republic Of)',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'S Republic Of',
            'KR' => 'Korea, Republic Of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'S Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macau',
            'MK' => 'Macedonia, Former Yugoslav Republic Of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands, Republic of the',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States Of',
            'MD' => 'Moldova, Republic Of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands, Commonwealth of the',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau, Republic of',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'KN' => 'Saint Kitts And Nevis',
            'LC' => 'Saint Lucia',
            'VC' => 'Saint Vincent And The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome And Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia (Slovak Republic)',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia, South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SH' => 'St. Helena',
            'PM' => 'St. Pierre And Miquelon',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard And Jan Mayen Islands',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic Of',
            'TH' => 'Thailand',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad And Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks And Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City, State of the',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands (British)',
            'VI' => 'Virgin Islands (U.S.)',
            'WF' => 'Wallis And Futuna Islands',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'YU' => 'Yugoslavia',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
            'WW' => 'Worldwide'
        );

        if ($countryCode == NULL) {
            return $options;
        } else {
            $countryName = '';
            foreach ($options as $key => $value) {
                if ($countryCode == $key) {
                    $countryName = $value;
                }
            }

            return $countryName;
        }
    }

    function getCountryNameByIp() {
        $client_ip = @$_SERVER['HTTP_CLIENT_IP'];
        $forward_ip = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $ip_addr = @$_SERVER['REMOTE_ADDR'];

       /* if (filter_var($client_ip, FILTER_VALIDATE_IP)) {
            $ip_addr = $client_ip;
        } elseif (filter_var($forward_ip, FILTER_VALIDATE_IP)) {
            $ip_addr = $forward_ip;
        } else {
            $ip_addr = $remote_ip;
        }*/

        $return_data = array('country' => '', 'city' => '');
        //$ip_data = @json_decode(file_get_contents("http://freegeoip.net/json/?q=" . $ip_addr));
        $ip_data = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip_addr));
	   $data='';	
	  if($ip_data['status'] == 'success') {
            $data['country'] = $ip_data['country'];
            $data['city'] = $ip_data['city'];
            $data['country_code'] = $ip_data['countryCode'];
        }else{
			$data['country'] ="India";
            $data['city'] = "";
            $data['country_code'] = "IN";
		}

        return $data;
    }

}

if (!function_exists('getFoodPref')) {

    function getFoodPref($fid = NULL) {

        $options = array(
            0 => 'Vegetarian',
            1 => 'Non-Vegetarian',
        );

        if (isset($fid)) {
            return $options[$rid];
        }
        return $options;
    }

}

if (!function_exists('getRelationships')) {

    function getRelationships($rid = NULL) {

        $options = array(
        	
            0 => 'Partner',
          //  1 => 'Wife',
           // 2 => 'Friend',
         //   3 => 'Daughter',
          //  5 => 'Son',
            101 => 'Self',
        );

        if (isset($rid)) {
            return $options[$rid];
        }
        return $options;
    }

}

if (!function_exists('getPaymentModes')) {

    function getPaymentModes($mode_id = NULL) {

        $options = array(
            0 => 'Online',
            1 => 'Cheque',
            2 => 'DD',
            3 => 'NEFT',
            4 => 'RTGS',
            5 => 'Cash'
        );

        if (isset($mode_id)) {
            return $options[$mode_id];
        }

        return $options;
    }

}
if (!function_exists('accommodation_type')) {
	function accommodation_type($acc_type=null){
		$options =array(
			0=>"-- Select --",
			1=>"Single",
			2=>"Double"
		);
		if (isset($acc_type)) {
            return $options[$acc_type];
        }

        return $options;
	}	
}
if (!function_exists('tour_type')) {
	function tour_type($tour_type=null){
		$options =array(
			0=>"-- Select --",
			1=>"Pre",
			2=>"Post"
		);
		if (isset($tour_type)) {
            return $options[$tour_type];
        }

        return $options;
	}	
}
if (!function_exists('hlpcountry_mode')){
	function hlpcountry_mode($country_code){
		$return=2;
		if ($country_code=='IN'){
			$return=1;
		}
		return $return;
	}
}
if (!function_exists('accdates')){
	function accdate(){
		$start=11;
		$end=19;
		$returnDate=array(
			0=>''
		);
		for($i=$start;$i<=$end;$i++){
			$returnDate[]=$i."/10/2016";
		}
		return $returnDate;
	}
}
if (!function_exists('formDateTimeDropDown')){
	function formDateTimeDropDown($dateArray,$fieldname,$timemode=true,$defaultValue=''){
		
		$defaultValue=date('m/d/Y',strtotime($defaultValue));
		
		$date="<select name='{$fieldname}' id='{$fieldname}'>";
		foreach ($dateArray as $key=>$value){
			$selected='';
			if ($defaultValue==$defaultValue)
				$selected=' selected ';
			$date.="<option value='{$value}' {$selected}>{$value}</option>";
		}
		$date.="</select>";
		$hours="<select name='{$fieldname}_hours' id='{$fieldname}_hours'>";
		for($i=0;$i<24;$i++){
			$value=(string)$i;
			if (strlen($value)==1){
				$value="0".$value;
			}
			$hours.="<option value='{$value}'>{$value}</option>";
		}
		$hours.="</select>";
		$minutes="<select name='{$fieldname}_minutes' id='{$fieldname}_minutes'>";
		for($i=0;$i<60;){
			$value=(string)$i;
			if (strlen($value)==1){
				$value="0".$value;
			}
			$minutes.="<option value='{$value}'>{$value}</option>";
			$i=$i+15;
		}
		$minutes.="</select>";
		if ($timemode){
			return $date.$hours.$minutes;
		}else{
			return $date;
		}
	}
	
}

if (!function_exists('daytourdates')){
	function daytourdates($tourValue=null){
		$options =array(
			0=>"-- Select --",
			1=>"14/10/2016",
			2=>"14/10/2016"
		);
		if (isset($tourValue)) {
            return $options[$tourValue];
        }

        return $options;
	}

}
if (!function_exists('transportionprice')){
	function transportionprice($tansportmode=null){
		$options =array(
			0=>"-- Select --",
			1=>600,
			2=>1000,
			3=>0
		);
		if (isset($tansportmode)) {
            return $options[$tansportmode];
        }

        return $options;
	}

}
if (!function_exists('event_cost_calc')){
	function event_cost_calc($num_delegates,$cost_array=0){
		if ($cost_array[1]==0)
			$cost_array[1]=$cost_array[0];
		$total_cost=0;
		if ($num_delegates>0){
		switch ($num_delegates){
			case 1:
				$total_cost=$cost_array[0];
				break;
			case 2:								
				$total_cost=$cost_array[1];
				break;
			default:
				$total_cost=$cost_array[1]+(($num_delegates-2)*$cost_array[0]);
				break;
		}
		}
		return $total_cost;
	}
}
if (!function_exists('fun_cost_double')){
	function fun_cost_double($cost_s,$cost_d){
		if ($cost_d==0)
			$cost_d=$cost_s*2;
		return $cost_d;	
	}
}
if (!function_exists('fun_transporation_mode')){
	function fun_transporation_mode($delegate_id){
		$this->ci = & get_instance();
		$this->ci->load->database();
		$partnerObject=$this->ci->db->query('select * from tbl_delegate_partner where delegate_id='.$delegate_id);
		$numPartners=$partnerObject->num_rows();
		//Check for Transport data update
		$transportObject=$this->ci->db->query('select * from tbl_transporation');
	}
}

function pagenavigation(){
	return ' <nav class="navbar-default">
    	 
    	
  
  <ul class="hymmenu nav navbar-nav" role="menu">
  <li><a href="/dashboard"><button type="button" class="btn btn btn-primary"><span class="glyphicon glyphicon-home"></span></button></a></li>
  <li><a href="/dashboard/dashboardview/1"><button type="button" class="btn btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></button></a></li>
  <li>&nbsp;&nbsp;&nbsp;</li>
  <li><a href="/delegate_partner/register" ><button type="button" class="btn btn btn-primary">Spouse/Partner</button></a></li>
    <li><a href="/event_registration/registration_form"><button type="button" class="btn btn btn-primary">Event Registration</button></a></li>
    <li><a href="/delegate_accommodation"><button type="button" class="btn btn btn-primary">Accommodation</button></a></li>
    <li><a href="/delegate_tours"><button type="button" class="btn btn btn-primary">Tours/Travel</button></a></li>
    
    <li><a href="/daytours_registration/registration"><button type="button" class="btn btn btn-primary">Day Tours</button></a></li>
    <li><a href="/delegate_transporation/registration"><button type="button" class="btn btn btn-primary">Pickup/Drop</button></a></li>
    
    
  </ul>
  
<div class="clearfix"></div>
  

    </nav>';
}