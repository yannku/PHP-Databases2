<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends MY_Controller {

    function __construct()
    {
        parent::__construct();
            }

    public function login()
	{
        $data = array(
            'form_action'   => 'login/submit',
            'form_inputs'          => array(
                'Email'         => array(
                    'type'          => 'email',
                    'placeholder'   => 'me@example.com',
                    'name'          => 'email',
                    'id'            => 'input-email',
                    'class'         => "input-group form-control"
                ),
                'Password'      => array(
                    'type'          => 'password',
                    'placeholder'   => 'password',
                    'name'          => 'password',
                    'id'            => 'input-password',
                    'class'         => "input-group form-control"
                )
            ),
            'buttons'       => array(
                'submit'        => array(
                    'type'          => 'submit',
                    'content'       => 'Log In',
                    'class'         => "btn btn-dark"
                )
            )
        );

        $this->build('login', $data);
	}

    public function register()
	{
        $data = array(
            'form_action'   => 'register/submit',
            'form_inputs'          => array(

                'Name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Joseph',
                    'name'          => 'name',
                    'id'            => 'input-name',
                    'class'         => "input-group form-control"
                ),
                'Surname'       => array(
                    'type'          => 'text',
                    'placeholder'   => 'Borg',
                    'name'          => 'surname',
                    'id'            => 'input-surname',
                    'class'         => "input-group form-control"
                ),
                'Email'         => array(
                    'type'          => 'email',
                    'placeholder'   => 'me@example.com',
                    'name'          => 'email',
                    'id'            => 'input-email',
                    'class'         => "input-group form-control"
                ),
                'Password'      => array(
                    'type'          => 'password',
                    'placeholder'   => 'password',
                    'name'          => 'password',
                    'id'            => 'input-password',
                    'class'         => "input-group form-control"
                ),

            ),

            'dropdown'  => $this->system->select_role(),
            'buttons'       => array(
                'submit'        => array(
                    'type'          => 'submit',
                    'content'       => 'register',
                    'class'         => "btn btn-dark"
                )
            )
        );

        $this->build_back('register', $data);

	}

    public function userform($action = 'edituserSubmit', $user = NULL){

        if ($user == NULL)
        {
            $user= array(
                    'name'              => NULL,
                    'surname'           => NULL,
                    'email'             => NULL,
                    'about'             => NULL,
                    'mobile'            => NULL
            );
        }
            $session = $this->session->userdata;
            $id = $session['id'];
            $userData = $this->user->set_user($id);

	       $data = array(
               'form_action'          => $action,
               'form_inputs'          => array(
                   'Id'          => array(
                       'type'          => 'hidden',
                       'placeholder'   => 'id',
                       'name'          => 'id',
                       'id'            => 'input-name',
                       'class'         => 'form-control',
                       'value'         => $id
                   ),
                    'Name'          => array(
                        'type'          => 'text',
                        'placeholder'   => 'Name',
                        'name'          => 'name',
                        'id'            => 'input-name',
                        'class'         => 'form-control',
                        'value'         => $userData['name']
                    ),
                    'Surname'          => array(
                        'type'          => 'text',
                        'placeholder'   => 'Surname',
                        'name'          => 'surname',
                        'id'            => 'input-surname',
                        'class'         => 'form-control',
                        'value'         => $userData['surname']
                    ),
                    'Email'          => array(
                        'type'          => 'email',
                        'placeholder'   => 'Email',
    					'name'          => 'email',
                        'id'            => 'input-email',
                        'class'         => 'form-control',
                        'value'         => $userData['email']
                    ),

                    'Mobile'          => array(
                        'type'          => 'number',
                        'placeholder'   => 'Mobile',
                        'name'          => 'mobile',
                        'id'            => 'input-mobile',
                        'class'         => 'form-control',
                        'value'         => $userData['mobile']
                    )
                ),
                'About'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Desribe your self and what your interests are',
                    'name'          => 'about',
                    'id'            => 'input-About',
                    'class'         => 'form-control',
                    'value'         => $userData['about']
                ),
                    'buttons'       => array(
                        'submit'        => array(
                            'type'          => 'submit',
                            'content'       => 'Update',
                            'class'         => "btn btn-dark"
                        )
                    )
            );

            $this->build_users('edituser', $data);


            }

    public function editUserSubmit()
    {
        $session = $this->session->userdata;
        $id = $session['id'];

        $name         	    = $this->input->post('name');
        $surname        	= $this->input->post('surname');
        $email      	    = $this->input->post('email');
        $mobile             = $this->input->post('mobile');
        $about   			= $this->input->post('about');
        //$this->user->set_user($id);
        if ($this->fv->run('userform') === FALSE) {
			echo validation_errors();
			return;
		}

        // update the user
		if (!$this->user->update_user($id, $name, $surname, $email, $about, $mobile)) {
			$this->fv->set_error('form', 'This info could not be updated.');
			$this->userform($id);
			return;
		}

        redirect('edituser');
    }

    # The Login Submission page
    public function login_submit()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('login') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. retrieve the data for checking
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        # 3. use the system model to verify the Password
        # this avoids exposing information
        $check = $this->system->check_password($email, $password);

        # 4. if check came back as FALSE, the password is wrong
        if($check === FALSE)
        {
            echo"this email and password don't match";
            return;

        }

        #5. rETRIEVE THE INFORMATION from the database
        #bin2hex converts binary data to hex(0-9, a-f)
        $code = bin2hex($this->encryption->create_key(16));

        #6. try to login
        $data = $this ->system->set_login_data($check, $code);

        #7. IF there's an error, stop Here

        if($data === FALSE)
        {
            echo"We could not log you in";
            return;
        }

        #8. WE'll check back in an hour
        $data['return'] = time() + 60 *60;

        #9. write everything to codeignitor's cookies
        $this->session->set_userdata($data);

        #10. Redirect home
        redirect('register');
    }

    # The Register Submission page
    public function register_submit()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('register') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. Retrieve the first set of data
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $role       = $this->input->post('roles');

        # 3. Generate a random keyword for added protection
        # Since the encrypted key is in binary, we should change it to a hex string (0-9, a-f)
        $salt       = bin2hex($this->encryption->create_key(8));

        # 3. Add them to the database, and retrieve the ID
        $id = $this->system->add_user($email, $password, $salt, $role);

        # 4. If the ID didn't register, we can't continue.
        if ($id === FALSE)
        {
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 5. Retrieve the next data
        $name       = $this->input->post('name');
        $surname    = $this->input->post('surname');

        # 6. Add the details to the next table
        $check = $this->system->user_details($id, $name, $surname);

        # 7. If the query failed, delete the user to avoid partial data.
        if ($check === FALSE)
        {
            $this->system->delete_user($id);
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 8. Everything is fine, return to the home page.
        redirect('/');
    }

    # The logout page
    public function logout()
    {

        #1. remove login data  from database
        $data = $this->session->userdata;
        $this->system->delete_session($data['id'], $data['session_code']);

        #2. Remove the information from the session.
        $this->session->unset_userdata(array(
            'id', 'email', 'name', 'surname', 'session_code'
        ));

        #3. take the user home
        redirect('login');
    }

    public function users() {

        // set the page data
        $data = array(
            'users'		=> $this->user->all_users()
        );

        // build the page
        $this->build_back('user_directory', $data);
    }

    public function students() {

        // set the page data
        $data = array(
            'students'		=> $this->user->all_students()
        );

        // build the page
        $this->build('students', $data);
    }

    public function view_student($id) {

        $data = array(
			'student'		=> $this->user->get_student($id)
		);

        $this->build('studentportfolio', $data);

    }

    public function delete($id)
    {
        // to make this work, in the page/html/php list
        // anchor('courses/delete/id', 'Delete')
        $this->user->delete_user($id);
        redirect('users');
    }

    public function studentpage(){
        $data =array(
            'users' => $this->session->all_userdata()
        );

        $this->build_users('studentpage', $data);
    }
}
