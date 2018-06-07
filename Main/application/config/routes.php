<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'system/login';
$route['login/submit'] = 'system/login_submit';

$route['register'] = 'system/register';
$route['register/submit'] = 'system/register_submit';

$route['logout'] = 'system/logout';


$route['add_course'] = 'courses/course_form';
$route['add_course/submit'] = 'courses/course_submit';

$route['applications'] = 'courses/applications';

$route['capply'] = 'courses/app_form';
$route['capply/submit'] = 'courses/app_submit';

$route['add_job'] = 'jobs/job_form';
$route['add_job/submit'] = 'jobs/job_submit';

$route['job_list'] = 'jobs/all_jobs_public';
$route['courses'] = 'courses/course_list';
$route['course_list'] = 'courses/courses';
$route['jobs_directory'] = 'jobs/all_jobs';
$route['users'] = 'system/users';
$route['student_page'] = 'system/studentpage';

$route['calendar'] = 'upload/calendar';
$route['timetables'] = 'upload/timetable';
$route['forms'] = 'upload/forms';
$route['edituser'] = 'system/userform';
$route['edituserSubmit'] = 'system/editUserSubmit';
$route['delete_user/(:num)'] = 'system/delete/$1';
$route['students'] = 'system/students';
$route['student_portfolio'] = 'system/view_student';

//$route['what/link/i/want'] = "system/function";
