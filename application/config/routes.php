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
$route['default_controller'] = 'home/home_i';
$route['login-process'] = 'login/process';
$route['admin'] = 'admin/dashboard';  // Rute untuk halaman admin
$route['admin-home'] = 'admin/home';  // Rute untuk halaman home admin
$route['admin-produk'] = 'admin/produk';  // Rute untuk halaman produk admin
$route['admin-orders'] = 'admin/orders';  // Rute untuk halaman produk admin
$route['admin-kemas_pro/(:num)'] = 'admin/kemas_pro/$1';
$route['admin-kirim_pro/(:num)'] = 'admin/kirim_pro/$1';



$route['admin-tambahpro'] = 'admin/tambah_produk';
$route['admin-save_product'] ='admin/save_product';
$route['admin-edit_pro/(:num)'] = 'admin/edit_produk/$1';
$route['admin-update_product'] = 'admin/update_product';
$route['admin-hapus_pro/(:num)'] = 'admin/hapus_produk/$1';

$route['admin/customers'] = 'admin/customers';  // Rute untuk halaman pelanggan admin
$route['admin/payments'] = 'admin/payments';  // Rute untuk halaman pembayaran admin
$route['admin/logout'] = 'admin/logout';  // Rute untuk logout admin
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['daftar'] = 'daftar';
$route['daftarklik'] = 'daftar/daftarklik';

$route['user'] = 'user/dashboard';  // Rute untuk halaman user
$route['user-home'] = 'user/home';  // Rute untuk halaman home admin
$route['user-produk'] = 'user/produk';  // Rute untuk halaman home admin
$route['user-keranjang'] = 'user/keranjang';  // Rute untuk halaman home admin
$route['user-checkout'] = 'user/checkout';  // Rute untuk halaman home admin

