<?php namespace wash;

class ResolverRoute 
{

    private $controllersDir;

    public function __construct ()
    {
        $this->controllersDir = $_SERVER['DOCUMENT_ROOT'] . '/src/controllers';
    }

    public function searchRoute ()
    {
        $type = strtolower($_SERVER['REQUEST_METHOD']);
        $url = $_SERVER['REDIRECT_URL'];
        $url = substr($url, -1) == '/' ? substr($url, 0, count($url)-2) : $url;
        $params = $_SERVER['QUERY_STRING'];
        
        $controllers = scandir($this->controllersDir);
        echo '\n'.json_encode($url);
        echo '\n'.json_encode($_SERVER);
        for($i = 0; $i < count($controllers); $i++)
        {
            $c = $controllers[$i];
            if(strpos($c, '.php') !== false)
            {
                $filePath = $this->controllersDir . '/' . $c;
                include_once $filePath;                
                $class = str_replace('.php', '', $c);
                $reflected = new \ReflectionClass($class);  
                $params = Wash::GetAnnotationParams($reflected->getDocComment());
                echo '\n Params';
                echo '\n'.json_encode($_SERVER);
                for($j = 0; $j < count($params); $j++)
                {                  
                    if(isset($params[Param::Route]) && strpos($url, strtolower('/'.$params[Param::Route])) === 0)
                    {                        
                        $methods = $reflected->getMethods();
                        
                        for($k = 0; $k < count($methods); $k++)
                        {  
                            $method = $methods[$k];
                            $methodParams = Wash::GetAnnotationParams($method->getDocComment());
                            if(isset($methodParams[Param::Route])){                            
                                $methodRoute = $methodParams[Param::Route] != "" ? '/' . $methodParams[Param::Route] : "";
                                $methodRoute = strtolower('/' . $params[Param::Route] . $methodRoute);
                                $methodType = isset($methodParams[Param::Method]) ? strtolower($methodParams[Param::Method]) : 'get';
                                if($type == $methodType && $this->isSameUrl($url, $methodRoute)) {
                                    return new RouteDef($filePath, $reflected, $method, $url, $methodRoute);
                                }
                            }
                        }                        
                    }
                }  
                       
            }
        }
        return null;
    }

    private function isSameUrl(string $url, string $route) : bool
    {
        if(strpos($route, '{') === false) return \strtolower($url) == \strtolower($route);
        
        $urlArray = explode('/', $url);
        $routeArray = explode('/', $route);

        if(count($urlArray) != count($routeArray )) return false;

        for($i = 0; $i < count($urlArray); $i++)
        {
            if($urlArray[$i] != $routeArray[$i] && strpos($routeArray[$i], '{') === false)
            {
                return false;
            }
        }

        return true;

    }

    public function getRequestArgs (RouteDef $route) : array
    {
        $params = $route->method->getParameters();
        $args = array();
        $urlArgs = $this->getURLArgs($route);
        $inputArgs = json_decode(file_get_contents('php://input'));
        
        for($i = 0; $i < count($params); $i++)
        {
            $name = $params[$i]->name;
            $arg = $this->getArg($name, $urlArgs, $inputArgs);

            if($arg != null)
            {
                $args[$name] = $arg;
            }
        }

        if(count($args) != count($params)) return false; 

        return array(
            "method" => $args, 
            "token" => $this->getArg('token', $urlArgs, $inputArgs)
        );
        
    }

    private function getArg ($name, $urlArgs, $inputArgs) 
    {
        $arg = null;

        if(isset($urlArgs[$name]))
        {
            $arg = $urlArgs[$name];
        }
        else if(isset($_GET[$name])) 
        {
            $arg = $_GET[$name];
        }
        else if(isset($_POST[$name]))
        {
            $arg = $_POST[$name];
        }
        else if(isset($inputArgs->$name))
        {
            $arg = $inputArgs->$name;
        }       

        return $arg;
    }

    private function getURLArgs(RouteDef $route) : array 
    {
        $args = array();        
        $urlArray = explode('/', $route->url);
        $routeArray = explode('/', $route->methodRoute);

        for($i = 0; $i < count($urlArray); $i++)
        {
            if(strpos($routeArray[$i], '{') !== false)
            {
                $name = str_replace('{', '', str_replace('}', '', $routeArray[$i]));
                $args[$name] = $urlArray[$i];
            }
        }

        return $args;
    }


}