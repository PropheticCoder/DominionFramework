<?php
namespace App;

use libraries\ConfigTool;

final class Config{
    public static function extract(string $setting){
        $DocumentRoot = $_SERVER['DOCUMENT_ROOT'] . "/DominionFramework";
        $ConfigDir = $DocumentRoot . "/.App/Config/.env";
        return parse_ini_file($ConfigDir)[$setting];
    }
}
?>