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
    private array $var = [];

    public function has(ContactCategory $category): bool
    {
        foreach ($this->var as $item) {
            if ($item == $category) {
                return true;
            }
        }
        return false;
    }

    public function add(ContactCategory $category): static
    {
        $this->var[] = $category;
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