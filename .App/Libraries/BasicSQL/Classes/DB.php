<?php
namespace libraries\BasicSQL;
use libraries\ConfigTool;

/**
 * DB Class, Connects to the database
 * @author PropheticCoder  https://github.com/PropheticCoder
 * @copyright PropheticCoder  https://github.com/PropheticCoder
 * @version 1.0
 */
class DB extends ConfigTool{
    
    /**ConfigTool */
    private static $host;
    private static $dbuser;
    private static $dbname;
    private static $dbpassword;

    protected static $tables=[];

    private static function UP(){
        self::$host= ConfigTool::extract('DB', 'HOST');
        self::$dbuser = ConfigTool::extract('DB', 'DBUSER');
        self::$dbname = ConfigTool::extract('DB', 'DBNAME');
        self::$dbpassword = ConfigTool::extract('DB', 'DBPASSWORD');
    }
    
    protected static function connect()
    {
        self::UP();
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbname;
        $pdo = new \PDO($dsn, self::$dbuser, self::$dbpassword);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $pdo;
    }

    protected static function scanDB()
    {
        self::UP();
        $db=mysqli_connect(self::$host,self::$dbuser,self::$dbpassword,self::$dbname);
        $query=mysqli_query($db, "SHOW tables");
        while($row=$query->fetch_assoc()){
            array_push(self::$tables, $row["Tables_in_the-news-company-db"]);
        }
    }
}
?>