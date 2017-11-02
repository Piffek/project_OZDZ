<?php
namespace App;
class Router
{
    public $router;
    
    /**
     * Load router.
     * 
     * @param unknown $fileWithRoutes file with router
     * @return \App\Router
     */
    public static function load($fileWithRoutes)
    {
        
        $router = new static;
        
        include $fileWithRoutes;
        
        return $router;
        
    }
    

    /**
     * 
     * Make get request.
     * 
     * @param string $url        name of URL.
     * @param string $controller name of Controller.
     * @param string $method     name of Method.
     */
    public function get(string $url, string $controller, string $method)
    {
    
        if($url === Request::getFirstPartOfUrl() && 'GET' === Request::getUrlMethod()) {
                
            return $this->ifMethodIsChecked($controller, $method);
        }
    }
    
    /**
     * 
     * Make post request.
     * 
     * @param string $url        name of URL.
     * @param string $controller name of Controller.
     * @param string $method     name of Method.
     */
    public function post(string $url, string $controller, string $method)
    {
        if($url === Request::getFirstPartOfUrl() && 'POST' === Request::getUrlMethod()) {
                
            return $this->ifMethodIsChecked($controller, $method);
        }
        
    }

    
    /**
     * 
     * If method and controller exists, inset this.
     * 
     * @param string $controller
     * @param string $method
     * @throws \Exception
     */
    public function ifMethodIsChecked(string $controller, string $method)
    {
        
        $className = '\\Src\\Controllers\\' . $controller;
        
        if(!method_exists($className, $method)) {
            
            throw new \Exception('in '.$controller.' not appear '.$method.' method');
            
        }
        
        $cont =  new $className(Request::groupURLToKeyAndValueAvailableInControllers());
        $cont->$method();
        
    }

}
