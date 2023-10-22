<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['surat'] = 'surat/index';
$route['tambah_surat'] = 'surat/store';
$route['edit_surat/(:num)'] = 'surat/edit/$1';
$route['delete_surat/(:num)'] = 'surat/delete/$1';
// dibawah ini progress
$route['edit_pengelola/(:num)'] = 'user/edit/$1';
$route['delete_pengelola/(:num)'] = 'user/delete/$1';
// dibawah ini belum selesai
$route['pengajuan'] = 'dashboard/pengajuan';
$route['pengajuan/index/(:num)'] = 'dashboard/pengajuan/$1';
$route['tolak_pengajuan/(:num)'] = 'pengajuan/tolak/$1';
$route['dashboard/index(:num)'] = 'dashboard/index/$1';
$route['riwayat_pengajuan'] = 'dashboard/riwayat';
$route['riwayat_pengajuan/index/(:num)'] = 'dashboard/riwayat/$1';

$route['ubah_status/(:num)'] = 'pengajuan/ubah_status/$1';
$route['tambah_pengajuan'] = 'pengajuan/store';
// $route['tambah_pengajuan/(:num)/(:num)'] = 'pengajuan/store/$1/$2';
