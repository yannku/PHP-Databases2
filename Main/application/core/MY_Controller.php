<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent:: __construct();
	}

    // We can use this to replace $this->load->view
    function build($pages = NULL, $data = NULL) {

		$start = array(
			'nav'		=> $this->nav_links()
		);

		$this->load->view('templates/header', $start);
		$this->load->view($pages, $data);
		$this->load->view('templates/footer');

	}

    function build_back($pages = NULL, $data = NULL) {

		$start = array(
			'nav'		=> $this->nav_links()
		);

		$this->load->view('templates/backheader', $start);
		$this->load->view($pages, $data);
		$this->load->view('templates/backfooter');

	}

    function build_users($pages = NULL, $data = NULL) {

		$start = array(
			'nav'		=> $this->nav_links()
		);

		$this->load->view('templates/userheader', $start);
		$this->load->view($pages, $data);
		$this->load->view('templates/userfooter');

	}

    // Use an associative array for the navigation
	function nav_links() {
		return array(

		);
	}

    protected function check_login()
    {
        #1. get the current session data into a variable
        $data = $this->session->userdata;

        #2. stop here if there is no session data
        if(!array_key_exists('session_code', $data))
        {
            return FALSE;
        }

        #3. if there is no refreh data or an hour has passed
        # check the login data.
        if(!array_key_exists('refreh', $data) || $data['refreh'] < time())
        {
            if($this->system->check_data($data['id'], $data['email'], $data['session_code']))
            {
                $data['refresh'] = time() + 60 * 60;
                return TRUE;
            }
            return FALSE;
        }

        #we don't have to check the data
        return TRUE;

    }

}
