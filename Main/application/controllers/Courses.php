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
		$this->build('addcourse', $data);

	}

    function view_course($id) {

        $this->load->model('course_model');


        $data = array(
			'course'		=> $this->course_model->get_course($id),
            'info'          => read_xml('courses/'.$id.'courseinfo.xml')
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
		$this->build_back('course_directory', $data);

	}
    public function course_list() {

		// load the database and model
		$this->load->model('course_model');

		// set the page data
		$data = array(
			'courses'		=> $this->course_model->all_courses()
		);

		// build the page
		$this->build('course_list', $data);

	}

    public function applications() {
		// load the database and model
		$this->load->model('course_model');

		// set the page data
		$data = array(
			'apps'		=> $this->course_model->all_applications()
		);

		// build the page
		$this->build_back('applications_directory', $data);

	}




    public function course_submit() {
		//this will show a 404 error if there is no data in the form
        $this->load->helper('basic_xml');
		if ($this->input->method() != "post") {
			show_404();
			return;
		}


		//check the form for validation issues
		if ($this->fv->run('course_form') === FALSE) {
			//echo validation_errors();
			echo validation_errors();
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
        $data = array(

            # This key is optional, used to define what kind of data you're writing.
            'root'      => 'course',

            # The structured information goes here.
            'data'      => array(

                'Requirments'                   => $this->input->post('c_req'),
                'Study_units'                   => $this->input->post('c_units'),
                'Carrier_opportunities'         => $this->input->post('c_job'),
                'Description'                   => $this->input->post('c_desc')

            )
        );

        write_xml($data, 'courses/'.$id.'courseinfo.xml');

        redirect('/');
	}

    // the edit process function (form submission)
	private function edit_submit() {

		// load the course_model
		$this->load->model('course_model');



		$id = $this->input->post('course_id');

		// check the form for validation errors
		if ($this->fv->run('edit_course') === FALSE) {
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
	public function app_submit(){
		//this will show a 404 error if there is no data in the form
		if ($this->input->method() != "post") {
			show_404();
			return;
		}
		//check the form for validation issues
		if ($this->fv->run('app_form') === FALSE) {
			//echo validation_errors();
			echo validation_errors();
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
        $tbl_courses_id         = $this->input->post('courses');

        // loads the users_model file to use its functions
        $this->load->model('course_model');

        $id = $this->course_model->course_apply($a_name, $a_surname, $a_dob, $a_idnumber, $a_address, $a_mobile, $a_email, $a_nationality, $tbl_courses_id );

        redirect('login');
	}

    # add course page
    public function course_form(){
        $this->load->model('course_model');
	       $data = array(
               'form_action'   => 'add_course/submit',
               'form_inputs'          => array(
                    'Course Name'          => array(
                        'type'          => 'text',
                        'placeholder'   => 'Course name',
                        'name'          => 'c_name',
                        'id'            => 'input-name',
                        'class'         => 'form-control'
                    ),
                    'Course Code'          => array(
                        'type'          => 'text',
                        'placeholder'   => 'Course code',
                        'name'          => 'c_code',
                        'id'            => 'input-code',
                        'class'         => 'form-control'
                    ),
                    'Course Duration'          => array(
                        'type'          => 'number',
                        'placeholder'   => 'Course duration',
    					'name'          => 'c_duration',
                        'id'            => 'input-duration',
                        'class'         => 'form-control'
                    ),
                    'MQF Level'          => array(
                        'type'          => 'number',
                        'placeholder'   => 'MQF level',
                        'name'          => 'c_mqf',
                        'id'            => 'input-mqf',
                        'class'         => 'form-control'
                    ),

                ),
                'Description'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course Description',
                    'name'          => 'c_desc',
                    'id'            => 'input-desc',
                    'class'         => 'form-control'
                ),
                'Requirments'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course Requirments',
                    'name'          => 'c_req',
                    'id'            => 'input-req',
                    'class'         => 'form-control'
                ),
                'Study_units'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course Study Units',
                    'name'          => 'c_units',
                    'id'            => 'input-unit',
                    'class'         => 'form-control'
                ),
                'Carrier_opportunities'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Course Carrier Opportunities',
                    'name'          => 'c_job',
                    'id'            => 'input-opp',
                    'class'         => 'form-control'
                ),

                    'buttons'       => array(
                        'submit'        => array(
                            'type'          => 'submit',
                            'content'       => 'Apply',
                            'class'         => "btn btn-dark"
                        )
                    )
            );

            $this->build_back('addcourse', $data);

            }

    public function app_form() {
        $this->load->model('course_model');

            $data = array(
               'form_action'   => 'capply/submit',
               'form_inputs'          => array(
        			'Name' => array(
        				'type' 				=> 'text',
        				'name' 				=> 'a_name',
        				'placeholder' 		=> 'Johnny',
        				'id' 				=> 'input-name',
                        'class'             => 'form-control'

        			),
        			'Surname' => array(
        				'type' 				=> 'text',
        				'name' 				=> 'a_surname',
        				'placeholder' 		=> 'Borg',
        				'id' 				=> 'input-surname',
                        'class'             => 'form-control'

        			),
                    'Date of birth' => array(
        				'type' 				=> 'date',
        				'name' 				=> 'a_dob',
        				'placeholder' 		=> '22/10/97',
        				'id' 				=> 'input-dob',
                        'class'             => 'form-control'

        			),
                    'Id number' => array(
                        'type' 				=> 'text',
                        'name' 				=> 'a_idnumber',
                        'placeholder' 		=> '123659M',
                        'id' 				=> 'input-idnumber',
                        'class'             => 'form-control'

                    ),
                    'Address' => array(
                        'type' 				=> 'text',
                        'name' 				=> 'a_address',
                        'placeholder' 		=> 'Triq il-Kbira',
                        'id' 				=> 'input-surname',
                        'class'             => 'form-control'

                    ),
                    'Mobile' => array(
        				'type' 				=> 'number',
        				'name' 				=> 'a_mobile',
        				'placeholder' 		=> '79797979',
        				'id' 				=> 'input-mobile',
                        'class'             => 'form-control'
        			),
                    'Email' => array(
        				'type' 				=> 'email',
        				'name' 				=> 'a_email',
        				'placeholder' 		=> 'johnny@cowboy.com.mt',
        				'id' 				=> 'input-email',
                        'class'             => 'form-control'
        			),
                    'Nationality' => array(
                        'type' 				=> 'text',
                        'name' 				=> 'a_nationality',
                        'placeholder' 		=> 'Maltese',
                        'id' 				=> 'input-nationality',
                        'class'             => 'form-control'
                    )

                ),
                'dropdown'  => $this->course_model->all_courses_dropdown(),
                'buttons'       => array(
                    'submit'        => array(
                        'type'          => 'submit',
                        'content'       => 'Apply',
                        'class'         => "btn btn-dark"
                    )
                )
		);
        $this->build('apply', $data);

	}
    public function delete($id)
    {
        $this->load->model('course_model');
        // to make this work, in the page/html/php list
        // anchor('courses/delete/id', 'Delete')
        $this->course_model->delete_course($id);
        redirect('courses');
    }

    public function application_delete($id)
    {
        $this->load->model('course_model');
        // to make this work, in the page/html/php list
        // anchor('courses/delete/id', 'Delete')
        $this->course_model->delete_application($id);
        redirect('applications');
    }

}
