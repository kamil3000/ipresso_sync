<?php


namespace Ipresso\Domain;


use DateTime;

class Activity implements Serializable
{
    private readonly int $id;
    private readonly string $name;
    private readonly string $key;
    private readonly string $jsKey;
    private readonly ActivityParameterCollection $parameter;
    private ?DateTime $date = null;

    /**
     * @return ActivityParameterCollection
     */
    public function getParameter(): ActivityParameterCollection
    {
        return $this->parameter;
    }

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }


    public function serialize(): array
    {
        $r = [];
        $r['key'] = $this->key;

        if ($this->date !== null) {
            $r['date'] = $this->date->format('Y-m-d H:i:s');
        }

        /** @var ActivityParameter $item */
        foreach ($this->parameter as $item) {

            if($item->getType() === ActivityParameter::MULTI){
                $r['parameter'][$item->getKey()] = $item->getValue();
                continue;
            }

            if ($item->getValue() instanceof DateTime) {
                $r['parameter'][$item->getKey()] = $item->getValue()->format('Y-m-d H:i');
                continue;
            }

            $r['parameter'][$item->getKey()] = (string)$item->getValue();
        }

        return $r;
    }
}