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
		$this->build_back('form', $data);

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
		$this->build_back('jobs_directory', $data);

	}

	public function all_jobs_public() {

		// load the database and model
		$this->load->model('job_model');

		// set the page data
		$data = array(
			'jobs'		=> $this->job_model->all_vacancies_public()
		);

		// build the page
		$this->build('job_list', $data);

	}

    public function job_submit(){
		//this will show a 404 error if there is no data in the form
		if ($this->input->method() != "post") {
			show_404();
			return;
		}

		//check the form for validation issues
		if ($this->fv->run('job_form') === FALSE) {
			//echo validation_errors();
			echo validation_errors();
			return;
		}

        $j_name         		= $this->input->post('j_name');
        $j_desc          	 	= $this->input->post('j_desc');
        $j_url      		 	= $this->input->post('j_url');
        $tbl_jroles_id   	 	= $this->input->post('jobs');

        // loads the users_model file to use its functions
        $this->load->model('job_model');

        $id = $this->job_model->add_vacancies($j_name, $j_desc, $j_url, $tbl_jroles_id);

        redirect('/');
	}

    public function job_form() {
    		$this->load->model('job_model');
			$data = array(
				'form_action'   => 'add_job/submit',
				'form_inputs'          =>array(
	                'j_name'          => array(
	                    'type'          => 'text',
	                    'placeholder'   => 'Job name',
	                    'name'          => 'j_name',
	                    'id'            => 'input-name',
						'class'         => 'form-control'
	                ),
	                'j_desc'          => array(
	                    'type'          => 'text',
	                    'placeholder'   => 'Job desc',
	                    'name'          => 'j_desc',
	                    'id'            => 'input-desc',
						'class'         => 'form-control'
	                ),
	                'j_url'          => array(
	                    'type'          => 'text',
	                    'placeholder'   => 'Link to job',
						'name'          => 'j_url',
	                    'id'            => 'input-url',
						'class'         => 'form-control',
	                )

	            ),
				'dropdown'  => $this->job_model->all_jobs_dropdown(),
				'buttons'       => array(
					'submit'        => array(
						'type'          => 'submit',
						'content'       => 'Add Job',
						'class'         => "btn btn-dark"
					)
				)
		);
			$this->build_back('addjob', $data);

        }

	public function delete($id)
	{
		// to make this work, in the page/html/php list
		// anchor('courses/delete/id', 'Delete')
		$this->job_model->delete_course($id);
		redirect('jobs');
	}

}
