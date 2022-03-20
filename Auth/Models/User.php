<?php
namespace libraries\Auth\Models;

/**
 * Users gets users table
 * @author PropheticCoder https://github.com/PropheticCoder
 * @copyright PropheticCoder https://github.com/PropheticCoder
 * @version 1.0
 */

use Exception;
use \libraries\BasicSQL\QUERY;
class User extends QUERY{
    protected static $fillable=[
        'id',
        'name',
        'lastName',
        'email',
        'cellphone',
        'password',
    ];

    /**
     * Checks if this Model is fully field
     */
    private static function stopIfNotFullyFilled(array $data){
        foreach(self::$fillable as $Fillable){
            if($Fillable !="id"){
                if(!isset($data[$Fillable])) throw new Exception('Missing values for User Model');
            }
        }
    }

    /**
     * Gets A User By Specified Data
     * @param int $userID
     * @param string $email
     * @param string $token
     */
    public static function get(int $userID=null,string $email=null,string $token=null)
    {
        $User=($userID) ? QUERY::SELECT('users', ['id' => $userID]) : [];
        $User = ($email) ? QUERY::SELECT('users', ['email' => $email]) : [];
        return $User;
    }

    public static function id(int $userID=null,string $email=null,string $token=null){
        $User = ($userID) ? QUERY::SELECT('users', ['id' => $userID,'role'=>'USER']) : [];
        $User = ($email) ? QUERY::SELECT('users', ['email' => $email, 'role' => 'USER']) : [];
        return $User[0]['id'];
    }
    
    /**
     * Creates a new user
     * @param int $userID
     * @param string $email
     * @param string $token
     */
    public static function create(array $data)
    {
        self::stopIfNotFullyFilled($data);
        QUERY::UPSERT('users',$data,['email'=>$data['email']]);
        return User::id(null, $data['email'],null);
    }
}
?>