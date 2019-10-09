<?php

namespace App;

use App;


session_start();

/**
 * auth user
 * 
 */
class Auth {

    private $_login;
    
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { 
            return $_SESSION["is_auth"];
        }
        else return false;
    }
    
    public function auth($login) {
            $_SESSION["is_auth"] = true;
            $_SESSION["login"] = $this->_login = $login;
            return true;
    }
    
    public function getLogin() {
        if ($this->isAuth()) {
            return $_SESSION["login"];
        }
    }
    
    
    public function out() {
        $_SESSION = array();
        session_destroy();
    }
}