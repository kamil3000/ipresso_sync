<?php

namespace Ipresso\Domain;


class Agreement
{
    /** @deprecated */
    const  HANDLOWA = '12';
    /** @deprecated */
    const  PROFILOWANIE = '14';
    /** @deprecated */
    const  MAIL_TELEFON = '11';
    /** @deprecated */
    const  ZDROWIE = '13';
    /** @deprecated */
    const  KONKURS = '15';

    private int $id;

    private string $descr;

    private string $name;

    private string $cant_delete;

    private bool $toRemove = false;

    public function isToRemove(): bool
    {
        return $this->toRemove;
    }

    public function setToRemove(bool $toRemove): void
    {
        $this->toRemove = $toRemove;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Agreement
    {
        $this->id = $id;
        return $this;
    }

    public function getDescr(): string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): Agreement
    {
        $this->descr = $descr;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Agreement
    {
        $this->name = $name;
        return $this;
    }

    public function getCantDelete()
    {
        return $this->cant_delete;
    }

    public function setCantDelete($cant_delete)
    {
        $this->cant_delete = $cant_delete;
        return $this;
    }


}