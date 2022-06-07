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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';
$route['app'] = 'auth/admin_page';


// Route admin

$route['dashboard'] = 'admin/AdminDashboard_controller/index';
$route['dashboard/account-delete/(:any)'] = 'admin/AdminDashboard_controller/hapus_pengguna/$1';
$route['dashboard/mahasiswa/delete/(:any)'] = 'admin/AdminDashboard_controller/delete_mahasiswa/$1';

$route['setting-profile'] = 'admin/AdminSetting_controller/index';
$route['setting-profile/update-profile/(:any)'] = 'admin/AdminSetting_controller/setting_akun/$1';
$route['setting-profile/update-password/(:any)'] = 'admin/AdminSetting_controller/setting_password/$1';

$route['post'] = 'admin/AdminPost_controller/index';
$route['post/post-new'] = 'admin/AdminPost_controller/tambahBerita';
$route['post/update-post/(:any)'] = 'admin/AdminPost_controller/update_berita/$1';
$route['post/delete-post/(:any)'] = 'admin/AdminPost_controller/delete_berita/$1';

$route['user-account'] = 'admin/AdminUserAccount_controller/index';
$route['user-account/add'] = 'admin/AdminUserAccount_controller/index';
$route['user-account/edit/(:any)'] = 'admin/AdminUserAccount_controller/update_account/$1';
$route['user-account/delete/(:any)'] = 'admin/AdminUserAccount_controller/delete_account/$1';

$route['data-mahasiswa'] = 'admin/AdminMahasiswa_controller/index';
$route['data-mahasiswa/add'] = 'admin/AdminMahasiswa_controller/index';
$route['data-mahasiswa/edit/(:any)'] = 'admin/AdminMahasiswa_controller/update_mahasiswa/$1';
$route['data-mahasiswa/delete/(:any)'] = 'admin/AdminMahasiswa_controller/delete_mahasiswa/$1';


$route['data-dosen'] = 'admin/AdminDosen_controller/index';
$route['data-dosen/add'] = 'admin/AdminDosen_controller/index';
$route['data-dosen/edit/(:any)'] = 'admin/AdminDosen_controller/update_dosen/$1';
$route['data-dosen/delete/(:any)'] = 'admin/AdminDosen_controller/delete_dosen/$1';



$route['data-matakuliah'] = 'admin/AdminMatakuliah_controller/index';
$route['data-matakuliah/add'] = 'admin/AdminMatakuliah_controller/index';
$route['data-matakuliah/edit/(:any)'] = 'admin/AdminMatakuliah_controller/update_matakuliah/$1';
$route['data-matakuliah/delete/(:any)'] = 'admin/AdminMatakuliah_controller/delete_matakuliah/$1';


$route['data-kelas'] = 'admin/AdminKelas_controller/index';
$route['data-kelas/add'] = 'admin/AdminKelas_controller/index';
$route['data-kelas/edit/(:any)'] = 'admin/AdminKelas_controller/update_kelas/$1';
$route['data-kelas/delete/(:any)'] = 'admin/AdminKelas_controller/delete_kelas/$1';
$route['data-kelas/show/(:any)'] = 'admin/AdminKelas_controller/detail_kelas/$1';


$route['data-krs'] = 'admin/AdminKrs_controller/index';
$route['data-krs/add'] = 'admin/AdminKrs_controller/index';
$route['data-krs/edit/(:any)'] = 'admin/AdminKrs_controller/update_krs/$1';
$route['data-krs/delete/(:any)'] = 'admin/AdminKrs_controller/delete_krs/$1';



$route['data-prodi'] = 'admin/AdminProdi_controller/index';
$route['data-prodi/add'] = 'admin/AdminProdi_controller/index';
$route['data-prodi/edit/(:any)'] = 'admin/AdminProdi_controller/update_prodi/$1';
$route['data-prodi/delete/(:any)'] = 'admin/AdminProdi_controller/delete_prodi/$1';



$route['data-perkuliahan'] = 'admin/AdminPerkuliahan_controller/index';
$route['data-perkuliahan/add'] = 'admin/AdminPerkuliahan_controller/index';
$route['data-perkuliahan/edit/(:any)'] = 'admin/AdminPerkuliahan_controller/edit_perkuliahan/$1';
$route['data-perkuliahan/delete/(:any)'] = 'admin/AdminPerkuliahan_controller/delete_perkuliahan/$1';





// users

$route['profile'] = 'users/profile';
$route['profile/update/(:any)'] = 'users/profile/setting_profile/$1';
$route['profile/change-password/(:any)'] = 'users/setting_password/$1';

$route['data-diri'] =  'users/mahasiswa_data';
$route['data-diri/update/(:any)'] =  'users/mahasiswa_data_update/$1';
$route['jadwal-perkuliahan'] = 'users/jadwal_perkuliahan';
