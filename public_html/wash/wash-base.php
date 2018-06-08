<?php namespace wash;

class WashBase
{

    public static function GetAnnotationParams (string $comment) : array
    {
        $match = array();
        $params = array();
        $pattern = '/@[\w]*\s*?=\s*?"[\w\-\/\{\}]*"*/';        
        preg_match_all( $pattern, $comment, $match );

        for($i = 0; $i < count($match[0]); $i++) 
        {
            $matchIn = array();
            preg_match_all( '/@[\w]*|"[\w\-\/\{\}]*/', $match[0][$i], $matchIn );
            $params[$matchIn[0][0]] = str_replace('"', '', $matchIn[0][1]);
            $f = 4;
        }
 
        return $params;
    }

    public static function Import (...$classes)
    {
        foreach($classes as $class) 
        {
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/src/' .  $class;
            
            if(!ResolverDependency::Import($filePath))
            {
                $filePath = $_SERVER['DOCUMENT_ROOT'] . '/src/entities/'. $class;
                ResolverDependency::Import($filePath);
            }
        }
    }

}
