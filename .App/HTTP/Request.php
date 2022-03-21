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

    protected static function getModelFromRoute(string $route): string{
        $brokenRoute = explode("/", $route);
        return ucfirst($brokenRoute[1]);
    }
    
    static protected function lowerCaseBrokenRequestUrl(array $brokenRequestUrl) :array{
        foreach ($brokenRequestUrl as $brokenRequestUrlStringKey => $brokenRequestUrlString) {
            $brokenRequestUrlString = strtolower($brokenRequestUrlString);
            $brokenRequestUrl[$brokenRequestUrlStringKey] = $brokenRequestUrlString;
        }
        return $brokenRequestUrl;
    }

    static protected function findKeysOfHostFrombrokenRequestUrl(array $brokenHost, array $brokenRequestUrl) :array{
        $foundHostKeys=[];
        foreach ($brokenHost as $brokenHostStringKey => $BrokenHostString) {
            $BrokenHostString = strtolower($BrokenHostString);
            $brokenHost[$brokenHostStringKey] = $BrokenHostString;
            if (in_array($BrokenHostString, $brokenRequestUrl)) {
                $tempKey = array_keys($brokenRequestUrl, $BrokenHostString);
                array_push($foundHostKeys, $tempKey);
            }
        }
        return $foundHostKeys;
    }

    static protected function removeHostFromBrokenRequestUrl(array $foundHostKeys,array $brokenRequestUrl) : array{
        foreach ($foundHostKeys as $hostsearchKey => $HostKeys) {
            foreach ($HostKeys as $HostKey) {
                unset($brokenRequestUrl[$HostKey]);
            }
        }
        return $brokenRequestUrl;
    }

    static protected function resetKeysOfBrokenRequestUrl(array $disturbedBrokenRequestUrl){
        $newBrokenRequestUrl = [];
        foreach ($disturbedBrokenRequestUrl as $brokenRequestUrlStringKey => $brokenRequestUrlString) {
            if ($brokenRequestUrlString == "") {
                unset($disturbedBrokenRequestUrl[$brokenRequestUrlStringKey]);
                continue;
            } else array_push($newBrokenRequestUrl, $brokenRequestUrlString);
        }
        return $newBrokenRequestUrl;
    }

    static protected function extractFirstElementOfBrokenRequestUrlAsModel(array $brokenRequestUrl):string{
        return ucfirst($brokenRequestUrl[0]);
    }

    static protected function ModelAndControllerDoNotExist(string $modelName) :bool{
        if (!file_exists(".App/Controllers/{$modelName}Controller.php") && !file_exists(".App/Models/{$modelName}Model.php")) return true;
        return false;
    }

    static protected function routeIsRequestedRoute(string $modelNameFromRoute,string $modelNameFromRequestUrl):bool{
        if ($modelNameFromRoute != $modelNameFromRequestUrl)  return false;
        return true;
    }

    static protected function extractParameterNamesFromRoute(string $route) : array{
        $parameters=[];
        $brokenRoute = explode("/", $route);
        $newRouteString = "";
        //Remove empty space and model name
        foreach ($brokenRoute as $brokenRouteStringKey => $brokenRouteString) {
            if ($brokenRouteString == "" || ucfirst($brokenRouteString) == ucfirst(self::getModelFromRoute($route))) {
                unset($brokenRoute[$brokenRouteStringKey]);
                continue;
            }
            $newRouteString .= $brokenRouteString;
        }

        $brokenNewRoute = explode("{", $newRouteString);
        $newRouteString = "";
        foreach ($brokenNewRoute as $brokenRouteStringKey => $brokenRouteString) {
            $newRouteString .= $brokenRouteString;
        }

        $brokenNewRoute = explode("}", $newRouteString);
        $newRouteString = "";
        foreach ($brokenNewRoute as $brokenRouteStringKey => $brokenRouteString) {
            if ($brokenRouteString != "") array_push($parameters, $brokenRouteString);
            $newRouteString .= $brokenRouteString;
        }
        return $parameters;
    }
    abstract static protected function callable(string $route);
}
?>