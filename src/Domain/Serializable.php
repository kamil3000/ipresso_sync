<?php


namespace Ipresso\Domain;


interface Serializable
{
    public function serialize(): array;
}