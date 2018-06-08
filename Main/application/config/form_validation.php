<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

    # The login form rules
    'login'         => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),

    # The register form rules
    'register'      => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'surname',
            'label' => 'Surname',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[tbl_login.email]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[8]|password_strength'
        )
    ),

    'app_form'      => array(
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
        )
    ),
    'course_form'   => array(
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
    ),
    'job_form'   => array(
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
            'field' => 'jobs',
            'label' => 'role',
            'rules' => 'required'
        )
    ),
    'userform'      => array(
        array(
            'field' => 'name',
            'label' => 'First Name',
            'rules' => 'required|min_length[3]'
        ),
        array(
            'field' => 'surname',
            'label' => 'Last Name',
            'rules' => 'required|min_length[3]'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile Number',
            'rules' => 'required|regex_match[/^[0-9]{8}$/]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'about',
            'label' => 'About',
            'rules' => 'required'
        )
    )

);
