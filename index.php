<?php

use App\Controllers\RewardController;
use App\Controllers\TestController;
use App\Interfaces\Controller;

require_once('.App/Config/Config.php');
require_once('.App/HTTP/Request.php');
require_once('.App/Router/Router.php');
echo $_SERVER['REQUEST_URI']."\t\t -Is Routed To index.php<br>";

var_dump(Router::get("/test/{uniqueCode}/{type}/{provider}/", function (string $uniqueCode,string $type,string $provider) {
    echo $uniqueCode;
}));