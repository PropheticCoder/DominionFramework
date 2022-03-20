<?php

use App\HTTP\Request;

final class Router extends Request{

    private static $routes=[
        'test'
    ];

    
    protected static function searchRouteInRequestUrl(string $route,string $foundRoute,int $searchCounter){
        self::listen();
        //Break Request Url To Array
        $brokenRequestUrl=explode("/",self::$requestUrl);
         //Break Host To Array
        $brokenHost=explode("/",self::$Host);
        //Search Host Keys
        $foundHostKeys=[];
        foreach($brokenHost as $BrokenHostString){
            if(in_array($BrokenHostString,$brokenRequestUrl)){
                $tempKey=array_keys($brokenRequestUrl,$BrokenHostString);
                array_push($foundHostKeys,$tempKey);
            }
        }
        //Unset The Host Keys And Have Only The String After The Host in brokenRequestUrl
        foreach($foundHostKeys as $hostsearchKey =>$HostKeys){
            foreach($HostKeys as $HostKey){
                unset($brokenRequestUrl[$HostKey]);
            }
        }
        return $brokenRequestUrl;
    }
    public static function get(string $route,callable $controller){
        $foundRoute="";
        return $foundRoute=self::searchRouteInRequestUrl($route,$foundRoute,0);
        return $controller;
    }

    public static function post(){
        
    }

    public static function put(){}
    
    public static function delete(){}
}
?>