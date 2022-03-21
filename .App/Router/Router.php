<?php

use App\HTTP\Request;

final class Router extends Request{
    private static $Controller;
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
        if(self::ModelAndControllerDoNotExist($modelNameFromRequestUrl)) return "MODEL_NOT_EXIST";
        if(self::routeIsRequestedRoute($modelNameFromRoute,$modelNameFromRequestUrl)){
            require_once(".App/Models/{$modelNameFromRoute}Model.php");
            require_once(".App/Controllers/{$modelNameFromRoute}Controller.php");
            $requestController= "\App\Controllers\\".$modelNameFromRoute . "Controller";
            self::$Controller=new $requestController;
            return true;
        }
        return false;
    }
    
    protected static function routeParameters(string $route,callable $router){
        $parameters = self::extractParameterNamesFromRoute($route);
        //Dynamically Generate Code To Construct Closure
        $passedFirstParameter=false;
        $closureSource='router(';
        foreach(self::$brokenRequestUrl as $brokenRequestUrlString){
            if(ucfirst($brokenRequestUrlString) != self::getModelFromRoute($route)){
                if($passedFirstParameter==false){
                    $closureSource .=$brokenRequestUrlString;
                    $passedFirstParameter=true;
                    continue;
                }else{
                    $closureSource .= ','.$brokenRequestUrlString;
                }
            }
        }
        $closureSource .=");";
        return ${$closureSource};
    }
    public static function get(string $route,callable $router){
        self::callable($route);
        return self::routeParameters($route,$router);
    }

}
?>