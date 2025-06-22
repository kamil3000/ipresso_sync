<?php

namespace Ipresso\Hydrator;

use ReflectionClass;

class AttributeHydrator
{
    public function hydrate(array $data, $object)
    {
        $properties = (new ReflectionClass($object))->getProperties();

        foreach ($properties as $property) {
            if (isset($data[$property->name])) {
                $object->{'set' . ucfirst($property->name)}($data[$property->name]);
            }
        }
        return $object;

    }
}