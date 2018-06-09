<?php namespace wash;

class Wash extends WashBase
{

    private $routeResolver;
    private $resolverDependency;

    public function go ()
    {
        $this->resolverRoute = new ResolverRoute();              
        $this->resolverDependency = new ResolverDependency();           

        $route = $this->resolverRoute->searchRoute(); 
        echo json_encode($route);
        if($route == null) 
        {
            return (new Controller())->json('Not Found', HTTP::NOT_FOUND);
        }
        
        $this->execRoute($route);
    }

    private function execRoute (RouteDef $route)
    {
        $controller = $this->resolverDependency->getController($route);        
        $args = $this->resolverRoute->getRequestArgs($route);        

        if($args === false) 
        {
            return (new Controller())->json('ERROR', HTTP::ERROR);
        }

        $methodCommentsParams = $commentsParam = Wash::GetAnnotationParams($route->method->getDocComment());
        
        if(isset($methodCommentsParams[Param::Guard]) && isset($controller->washGuardService)) 
        {
            $guardMethodName = $methodCommentsParams[Param::Guard];
            $guard = $controller->washGuardService->$guardMethodName($controller, $args['token']);
            
            if($guard === false)
            {
                return (new Controller())->json(false, HTTP::FORBIDDEN);
            }
            else if($guard !== true) 
            {
                return;
            }
        }

        $route->method->invokeArgs($controller, $args['method']);
    }
    
}