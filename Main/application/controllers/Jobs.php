<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller {
    // magic method to load the parent class
	function __construct() {
		// without this, we won't be able to
		// $this->build our pages.
		parent::__construct();
	}

    public function index()	{
        $data = array(
			'name'  => 'MCAST',
			'message'  => 'Just Run!!!!!'
		);

        $this->build('home', $data);

	}

    public function add_job($submit = FALSE) {

            // if the user submits the form, ignore the
            // rest of the function
            if ($submit == 'submit') {
                $this->job_submit();
                return;
            }

    		// load the form helper to get the function isndie the file otherwise known as a plugin
    		$this->load->helper('form');
    		// this array will contain all the inputs we will need
    		$data = array(
    			'properties'	=> array(
    				'action'	=> 'jobs/add_job/submit',
    				'hidden'	=> NULL
    			),
    			'form' => $this->job_form()
    		);
    		//the page itself
    		$this->build('form', $data);

    }

	// we need the = NULL part to avoid PHP errors
	public function edit_job($id = NULL) {

		// $id can be the word 'submit'. If so, we can just use the
		// edit_submit function.
		if ($id == 'submit') {
			$this->edit_job_submit();
			return;
		}

		$this->load->model('job_model');
		$job = $this->job_model->get_job($id);

		if ($job == NULL) {
			show_404();
			return;
		}

		// load the form helper to get the function isndie the file otherwise known as a plugin
		$this->load->helper('form');

		// this array will contain all the inputs we will need
		$data = array(
			'properties'	=> array(
				'action'	=> 'jobs/edit_job/submit',
				'hidden'	=> array('job_id' => $job['id'])
			),
			'form' => $this->job_form($job)
		);

		//the page itself
		$this->build('form', $data);

	}

	// the edit process function (form submission)
	private function edit_job_submit() {

		// load the form_validation library
		$this->load->library('form_validation');

		// load the users_model
		$this->load->model('job_model');

		//set the rules for each input - for edit
		// it will depend on the inputs being filled in
		$rules = array();

		$j_name = $this->input->post('j_name');
		if (!empty($j_name)) {
			$rules[] = array(
				'field' => 'j_name',
				'label' => 'Jobe name',
				'rules' => 'required|is_unique[tbl_job.j_name]'
			);
		}

		$j_desc = $this->input->post('j_desc');
		if (!empty($j_code)) {
			$rules[] = array(
				'field' => 'j_desc',
				'label' => 'Job desc',
				'rules' => 'required'
			);
		}

		$j_url = $this->input->post('j_url');
		if (!empty($j_url)) {
			$rules[] = array(
				'field' => 'j_url',
				'label' => 'link',
				'rules' => 'required'
			);
		}

		$tbl_jroles_id = $this->input->post('tbl_jroles_id');
		if (!empty($tbl_jroles_id)) {
			$rules[] = array(
				'field' => 'tbl_jroles_id',
				'label' => 'roles',
				'rules' => 'required'
			);
		}

		$id = $this->input->post('job_id');

		// set the rules
		$this->form_validation->set_rules($rules);

		// check the form for validation errors
		if ($this->form_validation->run() === FALSE) {
			$this->edit_job($id);
			return;
		}

		// check that the email inputted is taken by someone else
		if (!$this->job_model->unique_job($id, $j_name)) {
			$this->form_validation->set_error('j_name', 'This course already exists.');
			$this->edit_job($id);
			return;
		}

		// update the user
		if (!$this->job_model->update_job($id, $j_name, $j_desc, $j_url, $tbl_jroles_id)) {
			$this->form_validation->set_error('form', 'The job could not be updated.');
			$this->edit_job($id);
			return;
		}

		// reload the page
		$this->edit_job($id);

	}

	// a directory page for the registered users
	public function all_jobs() {

		// load the database and model
		$this->load->model('job_model');

		// set the page data
		$data = array(
			'jobs'		=> $this->job_model->all_vacancies()
		);

		// build the page
		$this->build('jobs_directory', $data);

	}

    private function job_submit(){
		//this will show a 404 error if there is no data in the form
		if ($this->input->method() != "post") {
			show_404();
			return;
		}
		//the form validation library makes it easier to check the form data
		$this->load->library('form_validation');

		//set the rules for each input
		$rules = array(
            array(
				'field' => 'j_name',
				'label' => 'Job Name',
				'rules' => 'required'
			),
            array(
				'field' => 'j_desc',
				'label' => 'Job desc',
				'rules' => 'required'
			),
			array(
				'field' => 'j_url',
				'label' => 'URL',
				'rules' => 'required'
			),
			array(
				'field' => 'tbl_jroles_id',
				'label' => 'role',
				'rules' => 'required'
			)
		);
		// prepare the rules for the validation of the form
		$this->form_validation->set_rules($rules);
		//check the form for validation issues
		if ($this->form_validation->run() === FALSE) {
			//echo validation_errors();
			$this->add_job();
			return;
		}

        $j_name         		= $this->input->post('j_name');
        $j_desc          	 	= $this->input->post('j_desc');
        $j_url      		 	= $this->input->post('j_url');
        $tbl_jroles_id   	 	= $this->input->post('tbl_jroles_id');

        // loads the users_model file to use its functions
        $this->load->model('job_model');

        $this->job_model->add_vacancies($j_name, $j_desc, $j_url, $tbl_jroles_id);

        echo "Good Job you submitted a form correctly";
	}

    private function job_form($user = NULL) {
        // if no information was provided, TO BE SAFe
		// create an empty reference
		if ($user == NULL) {
			$user = array(
				'j_name'		      => NULL,
				'j_desc'		      => NULL,
				'j_url'     	      => NULL,
				'tbl_jroles_id'		  => NULL
			);
		}

        return array(
                'j_name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Job name',
                    'name'          => 'j_name',
                    'id'            => 'input-name',
					'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('j_name', $user['j_name'])
                ),
                'j_desc'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Job desc',
                    'name'          => 'j_desc',
                    'id'            => 'input-desc',
					'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('j_desc', $user['j_desc'])
                ),
                'j_url'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'www.url.com',
					'name'          => 'j_url',
                    'id'            => 'input-url',
					'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('j_url', $user['j_url'])
                ),
                'tbl_jroles_id'          => array(
                    'type'          => 'number',
                    'placeholder'   => '2',
                    'name'          => 'tbl_jroles_id',
                    'id'            => 'role',
					'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('tbl_jroles_id', $user['tbl_jroles_id'])
                )
            );


        }


}
