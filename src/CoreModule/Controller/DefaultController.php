<?php
/**
 * Created by PhpStorm.
 * User: vgrdominik
 * Date: 3/11/14
 * Time: 15:10
 */

namespace CoreModule\Controller;

use CoreModule\Model\Entry;

class DefaultController
{
    function foo($twig)
    {
        $entry = new Entry();
        $entry->setName('test');

        $twig->display('src/CoreModule/View/view1.html.twig', array('test' => $entry->getName()));
    }
}