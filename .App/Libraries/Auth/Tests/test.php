<?php
require_once('../../ConfigTool/Classes/ConfigTool.php');
require_once('../../BasicSQL/Classes/DB.php');
require_once('../../BasicSQL/Classes/QUERY.php');
require_once('../../Auth/Models/Admin.php');
require_once('../../Auth/Models/User.php');
require_once('../../Auth/Classes/Auth.php');
require_once('../../../app/App.php');
require_once('../../Auth/Controllers/AuthenticationController.php');;
//var_dump(\libraries\Auth\Users\User::create(
//    ['name'=>'Npfariseni', 'lastName'=>'Maphiri','email'=>'npfarisenimaphiri@gmail.com','cellphone'=>'0740120033','password'=>'etywiqhdjgja','role'=>'User']
//));
//var_dump(\libraries\Auth\Users\User::get(1));
//var_dump(\libraries\Auth\Auth::register(
//    ['name' => 'Npfariseni', 'lastName' => 'Maphiri', 'email' => 'npfarisenimaphiri@gmail.com', 'cellphone' => '0740120033', 'password' => 'etywiqhdjgja','role'=>'USER']
//));
//
//var_dump(\libraries\Auth\Auth::register(
//    ['name' => 'Npfariseni', 'lastName' => 'Maphiri', 'email' => 'npfarisenimaphiri@gmail.com', 'cellphone' => '0740120033', 'password' => 'etywiqhdjgja', 'role' => 'ADMIN']
//));

\libraries\Auth\Controllers\AuthenticationController::UserIsNotAuthenticated();
?>