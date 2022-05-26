<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// $route['admin'] = 'admin/dashboard';
// $route['admin-mahasiswa'] = 'admin/mahasiswa/list';
// $route['admin-mahasiswa/insert'] = 'admin/mahasiswa/list';
// $route['admin-mahasiswa/delete/(:any)'] = 'admin/mahasiswa/delete/$1';
// $route['admin-mahasiswa/update/(:any)'] = 'admin/mahasiswa/update/$1';


// $route['admin-matakuliah'] = 'admin/matakuliah/list';
// $route['admin-matakuliah/insert'] = 'admin/matakuliah/list';
// $route['admin-matakuliah/delete/(:any)'] = 'admin/matakuliah/delete/$1';
// $route['admin-matakuliah/update/(:any)'] = 'admin/matakuliah/update/$1';

// $route['admin-prodi'] = 'admin/prodi/list';
// $route['admin-prodi/insert'] = 'admin/prodi/list';
// $route['admin-prodi/delete/(:any)'] = 'admin/prodi/delete/$1';
// $route['admin-prodi/update/(:any)'] = 'admin/prodi/update/$1';



// $route['admin/user-account'] = 'admin/account/list';
// $route['admin/user-account/insert'] = 'admin/account/list';
// $route['admin/user-account/delete/(:any)'] = 'admin/account/delete/$1';
// $route['admin/user-account/update/(:any)'] = 'admin/account/update/$1';


// $route['admin-ruang'] = 'admin/ruang/list';
// $route['admin-ruang/insert'] = 'admin/ruang/list';
// $route['admin-ruang/update/(:any)'] = 'admin/ruang/update/$1';


// $route['admin-dosen'] = 'admin/dosen/list';
// $route['admin-dosen/insert'] = 'admin/dosen/list';
// $route['admin-dosen/update/(:any)'] = 'admin/dosen/update/$1';
// $route['admin-dosen/delete/(:any)'] = 'admin/dosen/delete/$1';


// $route['admin-kelas'] = 'admin/kelas/list';
// $route['admin-kelas/insert'] = 'admin/kelas/list';
// $route['admin-kelas/delete/(:any)'] = 'admin/kelas/delete/$1';


// $route['login'] = 'auth/login';
// $route['access-admin'] = 'auth/login_admin';
// $route['logout'] = 'auth/logout';



// $route['users'] = 'users/dashboard';

$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';
