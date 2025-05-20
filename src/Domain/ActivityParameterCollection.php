<?php


namespace Ipresso\Domain;


class ActivityParameterCollection extends AbstractCollection
{
    /** @var \Ipresso\Domain\ActivityParameter[] */
    protected array $var = [];

    public function add(ActivityParameter $activityParameter)
    {
        parent::parentAdd($activityParameter);
    }
}