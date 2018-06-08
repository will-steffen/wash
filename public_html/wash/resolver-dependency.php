<?php namespace wash;

class ResolverDependency {

    private $services = array();
    private $serviceQueue = array();    
    private $servicesDir;
    private $repositoriesDir;
    private $entitiesDir;

    public function __construct() 
    {
        $this->servicesDir = $_SERVER['DOCUMENT_ROOT'] . '/src/services/';
        $this->repositoriesDir = $_SERVER['DOCUMENT_ROOT'] . '/src/repositories/';
        $this->entitiesDir = $_SERVER['DOCUMENT_ROOT'] . '/src/entities/';        
        // R conection goes here
    }
    
    public function getController (RouteDef $route) : Controller 
    {             
        $this->mapServices($route->class); 
        $controller = $this->resolveServiceDeps($route->class);
       
        return $controller;
    }

    private function mapServices (\ReflectionClass $class)
    {
        $properties = $class->getProperties();
        $commentsParam = Wash::GetAnnotationParams($class->getDocComment());
        
        if(isset($commentsParam[Param::Guard]))
        {
            $serviceName = $commentsParam[Param::Guard];
            $this->serviceQueue[$serviceName] = $serviceName;
            $this->services[$serviceName] = $this->getServiceInstance($serviceName);
        }

        for($i = 0; $i < count($properties); $i++)
        {
            $prop = $properties[$i];
            $comment = $prop->getDocComment();
            $annotations = Wash::GetAnnotationParams($comment);

            if(isset($annotations[Param::Service]) && !isset($this->serviceQueue[$annotations[Param::Service]])) {
                $serviceName = $annotations[Param::Service];
                $this->serviceQueue[$serviceName] = $serviceName;
                $this->services[$serviceName] = $this->getServiceInstance($serviceName);
            }
        }
        
        if(count($this->serviceQueue) == count($this->services))
        {            
            foreach($this->serviceQueue as $serviceName)
            {
                $reflectionClass = new \ReflectionClass($serviceName);
                
                $properties = $reflectionClass->getProperties();
                // repositories hook goes here

                for($i = 0; $i < count($properties); $i++)
                {
                    $prop = $properties[$i];
                    $comment = $prop->getDocComment();
                    $annotations = Wash::GetAnnotationParams($comment);

                    if(isset($annotations[Param::Service]))
                    {
                        $prop->setAccessible(true);
                        $prop->setValue($this->services[$prop->class], $this->services[$annotations[Param::Service]]);
                    }
                }
            }
        }
        
    }

    private function getServiceInstance (string $serviceName) : Service 
    {
        if(isset($this->services[$serviceName]))
        {
            return $this->services[$serviceName];
        }

        ResolverDependency::import($this->servicesDir . $serviceName);
        $reflectionClass = new \ReflectionClass($serviceName);
        $this->mapServices($reflectionClass);
        $object = new $serviceName;

        return $object;
    }

    private function resolveServiceDeps (\ReflectionClass $class) : WashClass 
    {    
        $object = $class->newInstance();
        $properties = $class->getProperties();
        $commentsParam = Wash::GetAnnotationParams($class->getDocComment());

        for($i = 0; $i < count($properties); $i++)
        {
            $prop = $properties[$i];
            $comment = $prop->getDocComment();
            $annotations = Wash::GetAnnotationParams($comment);

            if(isset($annotations[Param::Service]))
            {
                $serviceName = $annotations[Param::Service];
                $varName = $prop->name;

                if($object->$varName == null)
                {                    
                    $service = $this->services[$serviceName];
                    $prop->setAccessible(true);
                    $prop->setValue($object, $service);
                }
            }

            if($prop->name == 'washGuardService' && isset($commentsParam[Param::Guard]))
            {
                $service = $this->services[$commentsParam[Param::Guard]];
                $prop->setAccessible(true);
                $prop->setValue($object, $service);
            }
        }        
   
        return $object;
    }

    public static function Import(string $filePath) : bool
    {
        $filePath .= '.php';
        if(file_exists($filePath))
        {
            include_once $filePath;
            return true;
        }
        return false;
    }

}