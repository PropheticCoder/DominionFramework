<?php

use App\Controllers\RewardController;
use App\Interfaces\Controller;

require_once('.App/Config/Config.php');
require_once('.App/HTTP/Request.php');
require_once('.App/Router/Router.php');
require_once('.App/Controllers/TestController.php');
require_once('.App/Interfaces/Controller.php');
echo $_SERVER['REQUEST_URI']."\t\t -Is Routed To index.php<br>";
//$DATA="d";


var_dump(Router::get("/Reward/{type}/{provider}",function ($type,$provider){
    echo $type;echo $provider;
}));