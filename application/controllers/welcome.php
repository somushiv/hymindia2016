<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
    public function index() {
        $this->load->view('welcome_message');
    }

    public function check($abc = 0) {
        echo "testing" . $abc;
        echo "<a href='/welcome'>Welcome</a>";
        $this->template->add_js('var hello=0;', 'embed');
        $this->template->add_js('http://code.jquery.com/jquery-1.11.2.js');
        $this->template->render();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
