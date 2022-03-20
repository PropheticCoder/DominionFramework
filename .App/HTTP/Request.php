<?php
namespace App\HTTP;
use App\Config;
/**
 * Controlls Request Propertues
 */
abstract class Request{
    public static $requestUrl;
    public static $Host;
    /**
     * Listen To The URL The URL
     */
    protected static function listen(){
        self::$Host = Config::extract('HTTP_HOST');
        return self::$requestUrl=Config::extract('HTTP_HOST').$_SERVER['REQUEST_URI'];
    }

    abstract static protected function searchRouteInRequestUrl(string $route, string $foundRoute, int $searchCounter);
}
?>