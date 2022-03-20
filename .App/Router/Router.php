<?php

use App\HTTP\Request;

final class Router extends Request{

    private static $brokenRequestUrl;
    protected static function callable(string $route){
        self::listen();
        $brokenRequestUrl=explode("/",self::$requestUrl);
        $brokenHost=explode("/",self::$Host);
        $brokenRequestUrl=self::lowerCaseBrokenRequestUrl($brokenRequestUrl);
        $foundHostKeys= self::findKeysOfHostFrombrokenRequestUrl($brokenHost,$brokenRequestUrl);
        $brokenRequestUrl=self::removeHostFromBrokenRequestUrl($foundHostKeys,$brokenRequestUrl);
        $brokenRequestUrl=self::resetKeysOfBrokenRequestUrl($brokenRequestUrl);
        self::$brokenRequestUrl= $brokenRequestUrl;
        $modelNameFromRequestUrl=self::extractFirstElementOfBrokenRequestUrlAsModel($brokenRequestUrl);
        $modelNameFromRoute=self::getModelFromRoute($route);
        if(self::ModelAndControllerDoNotExist($modelNameFromRequestUrl)) return false;
        if(self::routeIsRequestedRoute($modelNameFromRoute,$modelNameFromRequestUrl)){
            require_once(".App/Models/{$modelNameFromRoute}Model.php");
            require_once(".App/Controllers/{$modelNameFromRoute}Controller.php");
            echo "This Route Executed! " . $route."<br>";
            return true;
        }
        return false;
    }
    
    protected static function routeParameters(string $route,callable $closure){
        $newBrokenUrl=[];
        foreach(self::$brokenRequestUrl as $brokenRequestUrlKey=>$brokenRequestUrlString){
            if(ucfirst($brokenRequestUrlString)==self::getModelFromRoute($route)){
                unset(self::$brokenRequestUrl[$brokenRequestUrlKey]);
                continue;
            }else array_push($newBrokenUrl, $brokenRequestUrlString);
        }
        $RouteParameters=self::extractParameterNamesFromRoute($route);
    }
    public static function get(string $route,callable $Parameters){
        if(self::callable($route)){
            return self::routeParameters($route,$Parameters);
        }
    }

    public static function post(){
        
    }

    public static function put(){}
    
    public static function delete(){}
}
?>