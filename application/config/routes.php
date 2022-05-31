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
$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';
$route['app'] = 'auth/admin_page';



// mahasiswa
$route['admin/mahasiswa/add'] = 'admin/mahasiswa';
$route['admin/mahasiswa/(:any)'] = 'admin/detail_mahasiswa/$1';
$route['admin/mahasiswa/edit/(:any)'] = 'admin/update_mahasiswa/$1';
$route['admin/mahasiswa/delete/(:any)'] = 'admin/delete_mahasiswa/$1';

// Dosen
$route['admin/dosen/add'] = 'admin/dosen';
$route['admin/dosen/edit/(:any)'] = 'admin/update_dosen/$1';
$route['admin/dosen/delete/(:any)'] = 'admin/delete_dosen/$1';


// matakuliah
$route['admin/matakuliah/add'] = 'admin/matakuliah';
$route['admin/matakuliah/edit/(:any)'] = 'admin/update_matakuliah/$1';
$route['admin/matakuliah/delete/(:any)'] = 'admin/delete_matakuliah/$1';


// kelas
$route['admin/kelas/add'] = 'admin/kelas';
$route['admin/kelas/edit/(:any)'] = 'admin/update_kelas/$1';
$route['admin/kelas/delete/(:any)'] = 'admin/delete_kelas/$1';


// krs
$route['admin/krs/add'] = 'admin/krs';
$route['admin/krs/delete/(:any)'] = 'admin/delete_krs/$1';
$route['admin/krs/edit/(:any)'] = 'admin/update_krs/$1';


// role
$route['menu/role_access/add'] = 'menu/role_access';
$route['menu/role_access/edit/(:any)'] = 'menu/update_role/$1';
$route['menu/role_access/delete/(:any)'] = 'menu/delete_role/$1';


// prodi    
$route['admin/prodi/add'] = 'admin/prodi';
$route['admin/prodi/edit/(:any)'] = 'admin/update_prodi/$1';
$route['admin/prodi/delete/(:any)'] = 'admin/delete_prodi/$1';


$route['admin/kuliah/add'] = 'admin/kuliah';
$route['admin/kuliah/delete/(:any)'] = 'admin/delete_perkuliahan/$1';
$route['admin/kuliah/edit/(:any)'] = 'admin/edit_perkuliahan/$1';
