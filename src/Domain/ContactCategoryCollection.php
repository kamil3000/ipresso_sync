<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 17:39
 */

namespace Ipresso\Domain;


use Iterator;

class ContactCategoryCollection implements Iterator
{
    private $var = array();

    public function has(ContactCategory $category): bool
    {
        foreach ($this->var as $item) {
            if ($item == $category) {
                return true;
            }
        }
        return false;
    }

    public function add( ContactCategory $category )
    {

        $this->var[] = $category;

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