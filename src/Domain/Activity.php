<?php


namespace Ipresso\Domain;


class  Activity
{
    private int $id;
    private string $name;
    private string $key;
    private string $jsKey;
    private ActivityParameterCollection $parameter;
}