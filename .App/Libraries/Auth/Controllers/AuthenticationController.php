<?php
namespace libraries\Auth\Controllers;
/**
 * Controlls authentication
 * @author PropheticCoder https://github.com/PropheticCoder
 * @copyright PropheticCoder https://github.com/PropheticCoder
 * @version 1.0
 */

use \Exception;
use libraries\Auth\Auth;
use \TheNewsCompany\App;

class AuthenticationController extends Auth{

    public static function UserIsNotAuthenticated(){
        if(!isset($_SESSION['token']))  
        return App::login('Please login');
    }
    
}
?>