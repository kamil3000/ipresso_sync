<?php


namespace Ipresso\Domain;


abstract class AbstractCollection implements \Iterator, \Countable
{

    protected array $var = [];

    protected function parentHas($contactAttribute): bool
    {
        foreach ($this->var as $item) {
            if ($item == $contactAttribute) {
                return true;
            }
        }
        return false;
    }

    public function getByKey(string $key)
    {
        foreach ($this->var as $item) {
            if ($item->getKey() === $key) {
                return $item;
            }
        }
        return null;
    }

    protected function parentAdd($agreement): static
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

    public function count(): int
    {
        return count($this->var);
    }
}