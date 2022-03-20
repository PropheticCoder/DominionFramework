<?php
//Testing App\Config
include($_SERVER['DOCUMENT_ROOT']."/DominionFramework/.App/Config/Config.php");
use App\Config;
$Config=new Config;
//Fetch Any Variable
var_dump($Config::extract('DB_HOST'));


?>