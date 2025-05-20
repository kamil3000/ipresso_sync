<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 09:35
 */

namespace Ipresso\Domain;


use Iterator;

class DiseaseUnitCollection implements Iterator
{
    private $var = [];

    public function has(DiseaseUnit $diseaseUnit): bool
    {
        foreach ($this->var as $item) {
            if ($item == $diseaseUnit) {
                return true;
            }
        }
        return false;
    }

    public function add(DiseaseUnit $diseaseUnit): static
    {

        $this->var[] = $diseaseUnit;

        return $this;
    }

    public function rewind(): void
    {
        reset($this->var);
    }

    public function current(): mixed
    {
        return current($this->var);
    }

    public function key(): mixed
    {
        return key($this->var);
    }

    public function next(): void
    {
        next($this->var);
    }

    public function valid(): bool
    {
        $key = key($this->var);
        return ($key !== NULL && $key !== FALSE);
    }

}