<?php

namespace Src;

class Request
{
    public $param = array();
    public static $paramOfGet = array();
    
    /**
     * Get first param from URL.
     * 
     * @return string
     */
    public static function getFirstPartOfUrl()
    {
        $url =  trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $arrWithUrl = explode('/', str_replace(['?'], ['/'], $url));
        return $arrWithUrl[0];
    }
    
    /**
     * Group url to metod and value.
     * 
     * @return array
     */
    public static function groupURLToKeyAndValueAvailableInControllers()
    {
        $path = trim($_SERVER['REQUEST_URI'], '/');

        @list($param) = explode('/',  str_replace(['?'], ['/'], $path), 1);

        if($param) {
            $equal = strpos($param, '=');
            if($equal){
                $paramReplace = str_replace(['?'], ['/'], $param);

                $paramEqual =  explode('=', $paramReplace);

                $methodAndParam = explode('/', $paramEqual[0]);


                array_push($methodAndParam, $paramEqual[1]);


                array_push(self::$paramOfGet, $methodAndParam);
            }

            if(!empty(self::$paramOfGet)){
                $param = self::$paramOfGet[0];
            }else{
                $param = explode('/', $path);
            }

            $key = array_search(self::getFirstPartOfUrl(), $param);

            unset($param[$key]);

            $parameters = array();

            foreach(array_chunk($param, 2) as $met){
                $parameters[$met[0]] = $met[1];
                
            }
            return $parameters;
        }
    }
    
    /**
     * Get method from URL.
     * 
     * @return string 
     */
    public static function getUrlMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    
    }
}