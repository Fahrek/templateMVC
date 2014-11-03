<?php
/**
 * Created by PhpStorm.
 * User: vgrdominik
 * Date: 3/11/14
 * Time: 15:30
 */
use Symfony\Component\Routing\Route;

$route = new Route('/foo', array('controller' => 'CoreModule\Controller\DefaultController::foo'));
$routes->add('route_name', $route);