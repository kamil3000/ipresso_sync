<?php


namespace Ipresso\Domain;


class DictionaryCollection extends AbstractCollection
{
    /** @var \Ipresso\Domain\Dictionary[] */
    protected array $var = [];

    public function add(Dictionary $activityParameter)
    {
        parent::parentAdd($activityParameter);
    }

    public function __toArray(): array
    {
        $out = [];

        foreach ($this->var as $item) {
            $out[] = $item->getValue();
        }

        return $out;
    }

}