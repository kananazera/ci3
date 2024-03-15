<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'HomeController';
$route['404_override'] = 'PageController/error404';
$route['translate_uri_dashes'] = TRUE;

$route['lang/(:any)'] = 'LanguageController/switchLang/$1';
$route['403'] = 'PageController/error403';
$route['contact'] = 'PageController/contact';
$route['about'] = 'PageController/about';
$route['privacy-policy'] = 'PageController/privacypolicy';
$route['terms-and-conditions'] = 'PageController/termsandconditions';
$route['register']['get'] = 'auth/RegisterController/index';
$route['register']['post'] = 'auth/RegisterController/register';
$route['login']['get'] = 'auth/LoginController/index';
$route['login']['post'] = 'auth/LoginController/login';
$route['logout'] = 'auth/LogoutController/logout';
$route['forgot-password'] = 'auth/PasswordController/index';
$route['forgot-password'] = 'auth/PasswordController/send';
