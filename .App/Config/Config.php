<?php
namespace App;
/**
 * Extract Config
 */
final class Config{
    public static function extract(string $setting){
        $DocumentRoot = $_SERVER['DOCUMENT_ROOT'] . "/DominionFramework";
        $ConfigDir = $DocumentRoot . "/.env";
        return parse_ini_file($ConfigDir)[$setting];
    }
}
?>