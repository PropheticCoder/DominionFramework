<?php
namespace libraries;
/**
 * Config
 * Fetches the specified config data
 * @author PropheticCoder https://github.com/PropheticCoder
 * @copyright PropheticCoder https://github.com/PropheticCoder
 * @version 1.0
 */
class ConfigTool{
    private $Host="localhost/";
    protected static function extract(string $config,string $setting){
        return parse_ini_file("../../ConfigTool/Configs/{$config}.ini")[$setting];
    }
}
?>