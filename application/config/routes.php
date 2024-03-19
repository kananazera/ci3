<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'HomeController';
$route['404_override'] = 'PageController/error404';
$route['translate_uri_dashes'] = TRUE;

//web
$route['lang/(:any)'] = 'LanguageController/switchLang/$1';
$route['403'] = 'PageController/error403';
$route['contact']['get'] = 'ContactController/index';
$route['contact']['post'] = 'ContactController/send';
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
$route['password/reset/(:any)']['get'] = 'auth/PasswordController/reset/$1';
$route['password/reset']['post'] = 'auth/PasswordController/change';
$route['profile'] = 'ProfileController/index';
$route['user/information']['post'] = 'ProfileController/updateInformation';
$route['user/password']['post'] = 'ProfileController/changePassword';
$route['user/photo']['post'] = 'ProfileController/uploadPhoto';

//api
$route['api/users'] = 'api/UserController/index';
$route['api/users/create'] = 'api/UserController/create';
$route['api/users/(:any)'] = 'api/UserController/show/$1';
$route['api/users/edit/(:any)'] = 'api/UserController/edit/$1';
$route['api/users/delete/(:any)'] = 'api/UserController/delete/$1';
