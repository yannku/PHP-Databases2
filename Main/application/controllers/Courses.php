<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends MY_Controller {

    function __construct()
    {
        parent:: __construct();
        // if the role shouldn't see this controller (permiassions)
        // show 404;
    }

    public function index()	{
        $data = array(
			'name'  => 'MCAST',
			'message'  => 'Just Run!!!!!'
		);

        $this->build('home', $data);

	}

    public function add_course($submit = FALSE) {

            // if the user submits the form, ignore the
            // rest of the function
            if ($submit == 'submit') {
                $this->course_submit();
                return;
            }

    		// load the form helper to get the function isndie the file otherwise known as a plugin
    		$this->load->helper('form'); $this->load->model('course_model');
    		// this array will contain all the inputs we will need
    		$data = array(
    			'properties'	=> array(
    				'action'	=> 'courses/add_course/submit',
    				'hidden'	=> NULL
    			),
    			'form' => $this->course_form()

    		);
    		//the page itself
    		$this->build('add_form', $data);

    }

    // we need the = NULL part to avoid PHP errors
	public function edit_course($id = NULL) {

		// $id can be the word 'submit'. If so, we can just use the
		// edit_submit function.
		if ($id == 'submit') {
			$this->edit_submit();
			return;
		}

		$this->load->model('course_model');
		$course = $this->course_model->get_course($id);

		if ($course == NULL) {
			show_404();
			return;
		}

		// load the form helper to get the function isndie the file otherwise known as a plugin
		$this->load->helper('form');

		// this array will contain all the inputs we will need
		$data = array(
			'properties'	=> array(
				'action'	=> 'courses/edit_course/submit',
				'hidden'	=> array('course_id' => $course['id'])
			),
			'form' => $this->course_form($course)
		);

		//the page itself
		$this->build('form', $data);

	}

    function view_course($id)
    {

        $this->load->model('course_model');

        $data = array(
			'course'		=> $this->course_model->get_course($id)
		);

        $this->build('course', $data);

    }

    // a directory page for the registered users
	public function courses() {

		// load the database and model
		$this->load->model('course_model');

		// set the page data
		$data = array(
			'courses'		=> $this->course_model->all_courses()
		);

		// build the page
		$this->build('course_directory', $data);

	}

    public function applications() {

		// load the database and model
		$this->load->model('course_model');

		// set the page data
		$data = array(
			'apps'		=> $this->course_model->all_applications()
		);

		// build the page
		$this->build('applications_directory', $data);

	}

    public function course_app($submit = FALSE) {

            // if the user submits the form, ignore the
            // rest of the function
            if ($submit == 'submit') {
                $this->app_submit();
                return;
            }
            // load the form helper to get the function isndie the file otherwise known as a plugin
    		//$this->load->helper('form');
            $this->load->model('course_model');

    		// this array will contain all the inputs we will need
    		$data = array(
    			'properties'	=> array(
    				'action'	=> 'courses/course_app/submit',
    				'hidden'	=> NULL
    			),
    			'form' => $this->app_form(),
                'dropdown'  => $this->course_model->all_courses_dropdown()
    		);
    		//the page itself
    		$this->build('form', $data);

    }



    private function course_submit(){
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
				'field' => 'c_name',
				'label' => 'Course Name',
				'rules' => 'required|is_unique[tbl_courses.c_name]'
			),
            array(
				'field' => 'c_code',
				'label' => 'Course Code',
				'rules' => 'required|min_length[5]'
			),
			array(
				'field' => 'c_duration',
				'label' => 'Course Duration',
				'rules' => 'required'
			),
			array(
				'field' => 'c_mqf',
				'label' => 'MQF Level',
				'rules' => 'required'
			)
		);
		// prepare the rules for the validation of the form
		$this->form_validation->set_rules($rules);
		//check the form for validation issues
		if ($this->form_validation->run() === FALSE) {
			//echo validation_errors();
			$this->add_course();
			return;
		}

        $c_name         	 = $this->input->post('c_name');
        $c_code          	 = $this->input->post('c_code');
        $c_duration      	 = $this->input->post('c_duration');
        $c_mqf   			 = $this->input->post('c_mqf');

        // loads the users_model file to use its functions
        $this->load->model('course_model');

        $id = $this->course_model->add_courses($c_name, $c_code, $c_duration, $c_mqf);
        // upload image here

        echo "Good Job you submitted a form correctly";
	}

    // the edit process function (form submission)
	private function edit_submit() {

		// load the form_validation library
		$this->load->library('form_validation');

		// load the users_model
		$this->load->model('course_model');

		//set the rules for each input - for edit
		// it will depend on the inputs being filled in
		$rules = array();

		$c_name = $this->input->post('c_name');
		if (!empty($c_name)) {
            $rules[] = array(
				'field' => 'c_name',
				'label' => 'Course name',
				'rules' => 'required|is_unique[tbl_courses.c_name]'
			);
		}

		$c_code = $this->input->post('c_code');
		if (!empty($c_code)) {
            $rules[] = array(
				'field' => 'c_code',
				'label' => 'Course code',
				'rules' => 'required|min_length[5]'
			);
		}

		$c_duration = $this->input->post('c_duration');
		if (!empty($c_duration)) {
            $rules[] = array(
				'field' => 'c_duration',
				'label' => 'Duration',
				'rules' => 'required'
			);
		}

		$c_mqf = $this->input->post('c_mqf');
		if (!empty($c_mqf)) {
            $rules[] = array(
				'field' => 'c_mqf',
				'label' => 'MQF',
				'rules' => 'required'
			);
		}

		$id = $this->input->post('course_id');

		// set the rules
		$this->form_validation->set_rules($rules);

		// check the form for validation errors
		if ($this->form_validation->run() === FALSE) {
			$this->edit_course($id);
			return;
		}

		// check that the email inputted is taken by someone else
		if (!$this->course_model->unique_name($id, $c_name)) {
			$this->form_validation->set_error('c_name', 'This course already exists.');
			$this->edit_course($id);
			return;
		}

		// update the user
		if (!$this->course_model->update_course($id, $c_name, $c_code, $c_duration, $c_mqf)) {
			$this->form_validation->set_error('form', 'The course could not be updated.');
			$this->edit_course($id);
			return;
		}

		// reload the page
		$this->edit_course($id);

	}

    // the user can't access this page from the URL
	private function app_submit(){
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
				'field' => 'a_name',
				'label' => 'First Name',
				'rules' => 'required|min_length[3]'
			),
			array(
				'field' => 'a_surname',
				'label' => 'Last Name',
				'rules' => 'required|min_length[3]'
			),
            array(
				'field' => 'a_dob',
				'label' => 'Date of birth',
				'rules' => 'required'
			),
            array(
				'field' => 'a_idnumber',
				'label' => 'Id-number',
				'rules' => 'required'
			),
            array(
				'field' => 'a_address',
				'label' => 'Home address',
				'rules' => 'required'
			),
            array(
				'field' => 'a_mobile',
				'label' => 'Mobile Number',
				'rules' => 'required|regex_match[/^[0-9]{8}$/]'
			),
            array(
				'field' => 'a_email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[tbl_courseapp.a_email]'
			),
            array(
				'field' => 'a_nationality',
				'label' => 'Nationality',
				'rules' => 'required'
			),
            array(
				'field' => 'tbl_courses_id',
				'label' => 'course',
				'rules' => 'required'
			)
		);
		// prepare the rules for the validation of the form
		$this->form_validation->set_rules($rules);
		//check the form for validation issues
		if ($this->form_validation->run() === FALSE) {
			//echo validation_errors();
			$this->course_app();
			return;
		}

        $a_name                 = $this->input->post('a_name');
        $a_surname              = $this->input->post('a_surname');
        $a_dob                  = $this->input->post('a_dob');
        $a_idnumber             = $this->input->post('a_idnumber');
        $a_address              = $this->input->post('a_address');
        $a_mobile               = $this->input->post('a_mobile');
        $a_email                = $this->input->post('a_email');
        $a_nationality          = $this->input->post('a_nationality');
        $tbl_courses_id         = $this->input->post('tbl_courses_id' );

        // loads the users_model file to use its functions
        $this->load->model('course_model');

        $this->course_model->course_apply($a_name, $a_surname, $a_dob, $a_idnumber, $a_address, $a_mobile, $a_email, $a_nationality, $tbl_courses_id );

        echo "Good Job you submitted a course application!!";
	}

    # add course page
    private function course_form($course = NULL) {
        // if no information was provided, TO BE SAFe
		// create an empty reference
		if ($course == NULL) {
			$course = array(
				'c_name'		=> NULL,
				'c_code'		=> NULL,
				'c_duration'	=> NULL,
				'c_mqf'			=> NULL
			);
		}

        return array(
                'Course Name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course name',
                    'name'          => 'c_name',
                    'id'            => 'input-name',
                    'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('c_name', $course['c_name'])
                ),
                'Course Code'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course code',
                    'name'          => 'c_code',
                    'id'            => 'input-code',
                    'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('c_code', $course['c_code'])
                ),
                'Course Duration'          => array(
                    'type'          => 'number',
                    'placeholder'   => '6',
					'name'          => 'c_duration',
                    'id'            => 'input-duration',
                    'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('c_duration', $course['c_duration'])
                ),
                'MQF Level'          => array(
                    'type'          => 'number',
                    'placeholder'   => '6',
                    'name'          => 'c_mqf',
                    'id'            => 'input-mqf',
                    'class'         => 'form-control',
                    'required' 			=> TRUE,
				    'value'				=> set_value('c_mqf', $course['c_mqf'])
                )
            );


            }

    private function app_form($app = NULL) {

		// if no information was provided, TO BE SAFe
		// create an empty reference
		if ($app == NULL) {
			$app = array(
                'a_name'            => NULL,
                'a_surname'         => NULL,
                'a_dob'             => NULL,
                'a_idnumber'        => NULL,
                'a_address'         => NULL,
                'a_mobile'          => NULL,
                'a_email'           => NULL,
                'a_nationality'     => NULL,
                'a_mqf'             => NULL,
                'tbl_courses_id'    => NULL
			);
		}

		return array(

			'Name' => array(
				'type' 				=> 'text',
				'name' 				=> 'a_name',
				'placeholder' 		=> 'Johnny',
				'id' 				=> 'input-name',
                'class'         => 'form-control',
				'required' 			=> TRUE,
				'value'				=> set_value('a_name', $app['a_name'])
			),
			'Surname' => array(
				'type' 				=> 'text',
				'name' 				=> 'a_surname',
				'placeholder' 		=> 'Borg',
				'id' 				=> 'input-surname',
                'class'         => 'form-control',
				'required' 			=> TRUE,
				'value'				=> set_value('a_surname', $app['a_surname'])
			),
            'Date of birth' => array(
				'type' 				=> 'date',
				'name' 				=> 'a_dob',
				'placeholder' 		=> '22/10/97',
				'id' 				=> 'input-dob',
                'class'         => 'form-control',
				'required' 			=> TRUE,
				'value'				=> set_value('a_dob', $app['a_dob'])
			),
            'Id number' => array(
                'type' 				=> 'text',
                'name' 				=> 'a_idnumber',
                'placeholder' 		=> '123659M',
                'id' 				=> 'input-idnumber',
                'class'         => 'form-control',
                'required' 			=> TRUE,
                'value'				=> set_value('a_idnumber', $app['a_idnumber'])
            ),
            'Address' => array(
                'type' 				=> 'text',
                'name' 				=> 'a_address',
                'placeholder' 		=> 'Triq il-Kbira',
                'id' 				=> 'input-surname',
                'class'         => 'form-control',
                'required' 			=> TRUE,
                'value'				=> set_value('a_address', $app['a_address'])
            ),
            'Mobile' => array(
				'type' 				=> 'number',
				'name' 				=> 'a_mobile',
				'placeholder' 		=> '79797979',
				'id' 				=> 'input-mobile',
                'class'         => 'form-control',
				'required' 			=> TRUE,
				'value'				=> set_value('a_mobile', $app['a_mobile'])
			),
            'Email' => array(
				'type' 				=> 'email',
				'name' 				=> 'a_email',
				'placeholder' 		=> 'johnny@cowboy.com.mt',
				'id' 				=> 'input-email',
                'class'         => 'form-control',
				'required' 			=> TRUE,
				'value'				=> set_value('a_email', $app['a_email'])
			),
            'Nationality' => array(
                'type' 				=> 'text',
                'name' 				=> 'a_nationality',
                'placeholder' 		=> 'Maltese',
                'id' 				=> 'input-nationality',
                'class'         => 'form-control',
                'required' 			=> TRUE,
                'value'				=> set_value('a_nationality', $app['a_nationality'])
            ),

            'Course'          => array(
                'type'          => 'number',
                'placeholder'   => '1',
                'name'          => 'tbl_courses_id',
                'id'            => 'input-mqf',
                'class'         => 'form-control',
                'required' 			=> TRUE,
                'value'				=> set_value('tbl_courses_id', $app['tbl_courses_id'])
            )
		);

	}

}
