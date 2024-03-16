<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'HomeController';
$route['404_override'] = 'PageController/error404';
$route['translate_uri_dashes'] = TRUE;

$route['lang/(:any)'] = 'LanguageController/switchLang/$1';
$route['403'] = 'PageController/error403';
$route['contact'] = 'PageController/contact';
$route['about'] = 'PageController/about';
$route['privacy-policy'] = 'PageController/privacyPolicy';
$route['terms-and-conditions'] = 'PageController/termsAndConditions';
$route['register']['get'] = 'auth/RegisterController/index';
$route['register']['post'] = 'auth/RegisterController/register';
$route['login']['get'] = 'auth/LoginController/index';
$route['login']['post'] = 'auth/LoginController/login';
$route['logout'] = 'auth/LogoutController/logout';
$route['forgot-password']['get'] = 'auth/PasswordController/index';
$route['forgot-password']['post'] = 'auth/PasswordController/send';
$route['profile'] = 'ProfileController/index';
$route['user/information']['post'] = 'ProfileController/updateInformation';
$route['user/password']['post'] = 'ProfileController/changePassword';
$route['user/photo']['post'] = 'ProfileController/uploadPhoto';
