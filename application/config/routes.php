<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "index.php";
$route['404_override'] = 'error';
$route['2014/washington/(:any)/(:any)'] = "2014_washington/$1/$2";
$route['2015/texas/(:any)/(:any)'] = "2015_texas/$1/$2";