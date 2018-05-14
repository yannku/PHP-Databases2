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

    // Use an associative array for the navigation
	function nav_links() {
		return array(

		);
	}
}
