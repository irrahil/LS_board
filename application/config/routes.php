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
//Обработчики user_ctrl
$route['cmd_reg_user'] 	= 'user_ctrl/reg_user';
$route['cmd_login'] 	= 'user_ctrl/login';
$route['cmd_edit_user'] = 'user_ctrl/edit_user_info';


//Обработчики board_ctrl
#$route['

//Отображение страниц user_ctrl
$route['registry'] 		= 'user_ctrl/view/reg_view';
$route['user'] 			= 'user_ctrl/get_user_info';
$route['restore'] 		= 'user_ctrl/view/restore_req_view';
$route['restoring'] 	= 'user_ctrl/view/restore_view';

//Отображение страниц board_ctrl
$route['board']			= 'board_ctrl/view/main_view';
$route['new_task'] 		= 'board_ctrl/view/new_task_view';
$route['task']			= 'board_ctrl/view/edit_task_view';
$route['new_cat']		= 'board_ctrl/view/new_category_view';
$route['cat']			= 'board_ctrl/view/edit_category_view';
$route['new_entry']		= 'board_ctrl/view/new_schedule_view';
$route['user_entry']	= 'board_ctrl/view/edit_schedule_view';
$route['new_status']	= 'board_ctrl/view/new_status_view';
$route['status']		= 'board_ctrl/view/edit_status_view';


$route['default_controller'] = 'user_ctrl/view';

$route['(:any)'] = 'user_ctrl/view/login_view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
