<?php
/**
 * Created by PhpStorm.
 * User: vgrdominik
 * Date: 3/11/14
 * Time: 11:20
 */

namespace CoreModule\Model;

class Entry
{
    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}