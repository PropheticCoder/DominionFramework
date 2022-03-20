<?php
namespace libraries\packageConsole;
/**
 * Console, writes object activity to a file
 * @author PropheticCoder https://github.com/PropheticCoder
 * @copyright PropheticCoder https://github.com/PropheticCoder
 * @version 1.0
 */
class PackageConsole{
    public static function createLogFile(){
        $logFile=fopen("bin/".session_id().".txt","w");
        $header= 
        "Log start time:  ".date("Y-m-d h:i:s",time());
        $header .= "\nsession_id         : ".session_id();
        fwrite($logFile,$header);
        fclose($logFile);
    }

    public static function writeLog(string $messege){
        $logFile = fopen("bin/" . session_id() . ".txt", "a");
        $line = "\n".date("Y-m-d h:i:s", time())." -> ".$messege;
        fwrite($logFile, $line);
        fclose($logFile);
    }
};
?>