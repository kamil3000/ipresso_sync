<?php


namespace Ipresso\Domain;


abstract class AbstractCollection implements \Iterator, \Countable
{

    protected array $var = [];

    protected function parentHas( $contactAttribute): bool
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

    protected function parentAdd($agreement)
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