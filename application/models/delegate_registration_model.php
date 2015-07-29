<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delegate_registration_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function update_registration($genpassword) {
    	$this->load->library("application_common_libs");
    	$hymCode=$this->application_common_libs->generate_hym_id($this->input->post('delegates_country'));
        $dataArray = array(
            'delegates_title' => $this->input->post('delegates_title'),
            'delegates_firstname' => $this->input->post('delegates_firstname'),
            'delegates_surname' => $this->input->post('delegates_surname'),
            'delegates_emailid' => $this->input->post('delegates_emailid'),
            'delegates_club_no' => $this->input->post('delegates_clubnumber'),
            'delegates_emailid' => $this->input->post('delegates_emailid'),
            'delegates_mobile' => $this->input->post('delegates_mobile'),
            'delegates_country' => $this->input->post('delegates_country'),
            'delegates_phone' => $this->input->post('delegates_phone'),
            'delegates_address1' => $this->input->post('delegates_address1'),
            'delegates_address2' => $this->input->post('delegates_address2'),
        	'delegates_post'=>$this->input->post('delegates_post'),
            'delegates_city' => $this->input->post('delegates_city'),
            'delegates_postalcode' => $this->input->post('delegates_postalcode'),
            'delegates_allergies' => $this->input->post('delegates_allergies'),
            'delegates_food_prefrence' => $this->input->post('delegates_food_prefrence'),
            'delegates_mode' => ($this->input->post('delegates_country') == 'IN') ? 1 : 2,
            'delegates_password' => $genpassword,
        	'delegates_hymcode'=>$hymCode
        );

        $this->db->insert('tbl_delegates', $dataArray);
        return $this->db->insert_id();
    }

    function getRegistrationStage($date) {


        $this->db->where("registration_stage_start_date < '$date'");
        $this->db->where("registration_stage_cut_off_date > '$date'");
        $query = $this->db->get('tb_registration_stage');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function getPackageDetails($psid, $country_mode) {
        $query = $this->db->order_by('visual_index','ASC')->get_where('tbl_packages_details', array('package_stage_id' => $psid,
        	 'country_mode' => $country_mode,'published'=>1));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function getPartnerDetails($del_id) {
        $del_id = isset($del_id) ? $del_id : 0;
        $this->db->order_by("updated_at", "desc");

        $query = $this->db->get_where('tbl_delegate_partner', array('delegate_id' => $del_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function getCountryCode($delegates_id = 0) {
        $delegates_id = isset($delegates_id) ? $delegates_id : 0;

        $this->db->limit(1);
        $query = $this->db->get_where('tbl_delegates', array('delegates_id' => $delegates_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->delegates_country;
            }
        }
        return false;
    }

    function getEmailID($email_id = '') {
        $email_id = isset($email_id) ? $email_id : '';

        $this->db->limit(1);
        $query = $this->db->get_where('tbl_delegates', array('delegates_emailid' => $email_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->delegates_emailid;
            }
        }
        return false;
    }

    function getEmailIDForPasswordReset($email_id = '') {
        $email_id = isset($email_id) ? $email_id : '';

        $this->db->limit(1);
        $query = $this->db->get_where('tbl_delegates', array('delegates_emailid' => $email_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['delegates_id'] = $row->delegates_id;
                $data['fname'] = $row->delegates_firstname;

                return $data;
            }
        }
        return false;
    }

    function getPartnerCountr($del_id) {
        $del_id = isset($del_id) ? $del_id : 0;
        $query = $this->db->get_where('tbl_delegate_partner', array('delegate_id' => $del_id));
        $partners_array[] = 0;
        $i = $query->num_rows();
        $j = 1;
        while ($i) {
            $partners_array[] = $j++;
            $i--;
        }
        return $partners_array;
    }

    function getAccommodationPlaces($country_mode) {
        $query = $this->db->get_where('tbl_accomodation_place', array('country_mode' => $country_mode));
        $i = 1;
        $j = 1;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($i == 1) {
                    $data[0] = "Single";
                    $i++;
                } else if ($j == 4) {
                    $data[4] = "Double";
                } else {
                    $data[$row->accomodation_place_id] = $row->accomodation_place_name;
                    $j++;
                }
            }
            return $data;
        }
        return false;
    }

    function getAccomodationBookedDetails($del_id) {
        $del_id = isset($del_id) ? $del_id : 0;
        $this->db->where("tbl_accomodation.delegate_id = '$del_id'");
        $this->db->limit(1);
        $this->db->select('*');
        $this->db->from('tbl_accomodation_place');
        $this->db->join('tbl_accomodation', 'tbl_accomodation.accomodation_place_id = tbl_accomodation_place.accomodation_place_id');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function getTravelBookedDetails($del_id) {
        $del_id = isset($del_id) ? $del_id : 0;
        $this->db->where("tbl_tour_master.delegate_id = '$del_id'");
        $this->db->limit(1);
        $this->db->select('*');
        $this->db->from('tbl_tours_places');
        $this->db->join('tbl_tour_master', 'tbl_tour_master.delegate_tourplace_id = tbl_tours_places.tours_places_id');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function getTransportationBookedDetails($del_id) {
        $del_id = isset($del_id) ? $del_id : 0;

        $this->db->limit(2);
        $query = $this->db->get_where('tbl_transporation', array('delegate_id' => $del_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                 $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}
