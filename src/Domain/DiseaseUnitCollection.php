<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 09:35
 */

namespace Ipresso\Domain;


class DiseaseUnitCollection implements \Iterator
{
    private $var = array();

    public function has( DiseaseUnit $diseaseUnit ): bool
    {
        foreach ($this->var as $item) {
            if ($item == $diseaseUnit) {
                return true;
            }
        }
        return false;
    }

    public function add( DiseaseUnit $diseaseUnit )
    {

        $this->var[] = $diseaseUnit;

        return $this;
    }

    public function rewind()
    {
        reset($this->var);
    }

    public function current()
    {
        $var = current($this->var);

        return $var;
    }

    public function key()
    {
        $var = key($this->var);

        return $var;
    }

    public function next()
    {
        $var = next($this->var);
        return $var;
    }

    public function valid()
    {
        $key = key($this->var);
        $var = ($key !== NULL && $key !== FALSE);

        return $var;
    }

}