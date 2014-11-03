<?php
/**
 * Created by El desarrollador otaku.
 * User: vgrdominik
 * Date: 16/02/13
 * Time: 16:15
 */
function __autoload($className)
{
    $classNameArray = explode('\\', strrev($className), 2);
    $classNameArray[0] = strrev($classNameArray[0]);
    if(!empty($classNameArray[1]))
    {
        $classNameArray[1] = strrev($classNameArray[1]);
    }
    if(!empty($classNameArray[1]))
    {
        $fileName = str_replace('\\', '/', $classNameArray[1]).'/'.$classNameArray[0];
    }else{
        $fileName = $classNameArray[0];
    }
    $extension = '';
    if(is_file('src/' . $fileName . '.class.php'))
    {
        $extension = 'class';
    }elseif(is_file('src/' . $fileName . '.interface.php'))
    {
        $extension = 'interface';
    }

    if (is_file($file = 'vendor/symfony/routing/'.$fileName.'.php'))
    {
        require $file;
    }elseif (is_file($file = 'vendor/twig/twig/lib/'.str_replace(array('_', "\0"), array('/', ''), $className).'.php'))
    {
        require $file;
    }elseif(!empty($extension))
    {
        $path = 'src/' . $fileName . '.' . $extension . '.php';
        require_once $path;
    }else{
        $path = 'src/' . $fileName . '.php';
        if(is_file($path))
        {
            require_once $path;
        }else{
            throw new Exception('Clase no encontrada');
        }
    }
}

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

try{
    $routes = new RouteCollection();

    include('routing.php');

    $context = new RequestContext($_SERVER['REQUEST_URI']);

    $matcher = new UrlMatcher($routes, $context);

    $context = $matcher->getContext();
    $parameters = $matcher->match($context->getBaseUrl());

    $loader = new Twig_Loader_Filesystem('./');
    $twig = new Twig_Environment($loader, array(
        //'debug' => true,
        //'cache' => './cache',
    ));

    $escaper = new Twig_Extension_Escaper('html');
    $twig->addExtension($escaper);

    $twig->clearCacheFiles();
    $twig->clearTemplateCache();

    call_user_func_array(explode('::', $parameters['controller']), array($twig));

}catch (Exception $e)
{
    echo $e->getMessage();
}