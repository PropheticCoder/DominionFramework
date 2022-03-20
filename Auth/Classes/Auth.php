<?php
namespace libraries\Auth;
use \Exception;
use libraries\Auth\Models\Admin;
use \libraries\Auth\Models\User;
/**
 * Handles User Account
 * @author PropheticCoder https://github.com/PropheticCoder
 * @copyright PropheticCoder https://github.com/PropheticCoder
 * @version 1.0
 */
class Auth{
    protected static $Role;
    protected static $KnownRoles=[
        'USER',
        'ADMIN'
    ];

    private static function User(){
        return User::class;
    }

    private static function Admin()
    {
        return Admin::class;
    }
    
    private static function stopIfRoleIsUnknown(){
        if(!in_array(self::$Role,self::$KnownRoles)) throw new Exception('Unknown role');
    }
    
    private static function stopIfRegistrationHasNoRole(array $data){
        if(!isset($data['role'])) throw new \Exception('Registration data has no role');
    }
    

    protected static function register(array $data){
        self::stopIfRegistrationHasNoRole($data);
        self::$Role=$data['role'];
        self::stopIfRoleIsUnknown();
        if(self::$Role=='USER') return self::User()::create($data);
        if (self::$Role == 'ADMIN') return self::Admin()::create($data);
    }
}
?>