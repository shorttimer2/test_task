<?php

namespace App;

class Router

{
    
    public function resolve (){
        
        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        $result[0] = array_shift($route);
        $result[1] = array_shift($route);
        $result[2] = $route;
        return $result;
        
    }
    
    public function resolveRef() {
        
        $result = array();
        if(($pos = strpos($_SERVER['HTTP_REFERER'], '?')) !== false){
            $route = substr($_SERVER['HTTP_REFERER'], ++$pos, strlen($_SERVER['HTTP_REFERER']));
            
        $params = explode('&', $route);
        foreach ($params as $param)
            {   
            $a = explode('=',$param);
            array_push($result,$a[1]);
            }            
        }
        
       
        return $result;
    }
    
}