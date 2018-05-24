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
        redirect('home/success');
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
        redirect('/');
    }
}
