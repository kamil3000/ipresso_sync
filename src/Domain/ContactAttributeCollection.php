<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:07
 */

namespace Ipresso\Domain;

use Countable;
use Iterator;

class ContactAttributeCollection implements Iterator, Countable
{
    private $var = array();

    public function has(ContactAttributeInterface $agreement): bool
    {
        foreach ($this->var as $item) {
            if ($item == $agreement) {
                return true;
            }
        }
        return false;
    }

    public function add(ContactAttributeInterface $agreement)
    {

        $this->var[] = $agreement;

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

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->var);
    }
}