<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:07
 */

namespace Ipresso\Domain;

use Iterator;

class AgreementCollection implements Iterator
{
    private array $var = [];

    public function has(Agreement $agreement): bool
    {
        foreach ($this->var as $item) {
            if ($item == $agreement) {
                return true;
            }
        }
        return false;
    }

    public function add(Agreement $agreement): static
    {
        $this->var[] = $agreement;
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