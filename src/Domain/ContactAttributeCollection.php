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
    /** @var ContactAttributeInterface[] */
    private array $var = [];

    public function remove(string $key): self
    {
        foreach ($this->var as $storageKey => $item) {
            if ($item->getKey() === $key) {
                unset($this->var[$storageKey]);
            }
        }
        return $this;
    }

    public function has(ContactAttributeInterface $contactAttribute): bool
    {
        foreach ($this->var as $item) {
            if ($item == $contactAttribute) {
                return true;
            }
        }
        return false;
    }

    public function getByKey(string $key): ?ContactAttributeInterface
    {
        foreach ($this->var as $item) {
            if ($item->getKey() === $key) {
                return $item;
            }
        }
        return null;
    }

    public function add(ContactAttributeInterface $agreement): static
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

    public function key(): string|int|null
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