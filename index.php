<?php
require_once('.App/Config/Config.php');
require_once('.App/HTTP/Request.php');
require_once('.App/Router/Router.php');
echo $_SERVER['REQUEST_URI']."\t\t -Is Routed To index.php<br>";
//$DATA="d";
var_dump(Router::get("test/{DATA}",function($DATA){
    return $DATA;
}));
?>