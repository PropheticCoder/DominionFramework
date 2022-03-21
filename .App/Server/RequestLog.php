<?php
namespace App\Server;

class RequestLog{
    public function __construct(){
        echo $_SERVER['REQUEST_URI'] . "\t\t -Is Served By ROOT/index.php<br>";
        $RedirectUrl= (isset($_SERVER['REDIRECT_URL'])) ? $_SERVER['REDIRECT_URL'] : "";
        $Log
        = $_SERVER['SERVER_PROTOCOL'] . " - " . $_SERVER['REQUEST_METHOD'] . "  " . $_SERVER['REMOTE_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . $RedirectUrl;
        $logFile = fopen(".App/Server/Logs/Requests.txt", "a");
        fwrite($logFile, $Log."\n");
        fclose($logFile);
    }
}
?>