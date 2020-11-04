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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$data = explode("/",$_SERVER['REQUEST_URI']);

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Gunakan ini untuk meredirect halaman
// $route['settingan_alamat_url'] = "controlller_class/controller_function";

//Login And Register Action
$route['login_admin'] = "login/admin";
$route['login_action'] = "login/action";
$route['register_action'] = "register/action";

//Register AJAX Request
$route['username_checker'] = "register/username_checker";
$route['provinsi_selector'] = "register/provinsi_selector";
$route['kota_selector'] = "register/kota_selector";

//Dashboard Controller
$route['saksi'] = "dashboard/saksi";
$route['caleg'] = "dashboard/caleg";
$route['tps'] = "dashboard/tps";
$route['saksi_partai'] = "dashboard/saksi_partai";
// $route['view'] = "dashboard/view";

//Dashboard AJAX Request
$route['active_user'] = "dashboard/active_user";

//Legislatif Controller
$route['dpr_ri'] = "legislatif/dpr_ri";
$route['dpd_ri'] = "legislatif/dpd_ri";
$route['dprd_provinsi'] = "legislatif/dprd_provinsi";
$route['dprd_kota'] = "legislatif/dprd_kota";

//User Controller
$route['generate'] = "user/generate";

//User AJAX Request
$route['caleg_deleting'] ="user/delete_caleg";
$route['generate_user'] = "user/generate_user";
$route['saksi_user_deleting'] = "user/delete_user";
$route['generate_provinsi'] = "user/provinsi_selector";
$route['generate_kota'] = "user/kota_selector";
$route['generate_kecamatan'] = "user/kecamatan_selector";
$route['saksi_checking'] = "user/saksi_checking";

//Suara Saksi Controller
$route['suara_control'] = "suara/suara_adding";
$route['suara_view'] = "suara/suara_view";

//Suara AJAX Request
$route['suara_targeting'] = "suara/target_adding";