<?php
namespace libraries\ConfigTool;
function autoload(string $classType,string $className){
    require_once(__DIR__.DIRECTORY_SEPARATOR.$classType.DIRECTORY_SEPARATOR.$className.".php");
}
?>