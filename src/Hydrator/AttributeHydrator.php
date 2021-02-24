<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 09:20
 */

namespace Ipresso\Hydrator;


class AttributeHydrator
{
    public function hydrate(array $data, $object)
    {
        //   echo "<pre>" . print_r($data, true) . "</pre>";
        $properties = (new \ReflectionClass($object))->getProperties();

        foreach ($properties as $property) {
            if (isset($data[$property->name])) {
                $object->{'set' . ucfirst($property->name)}($data[$property->name]);
            }
        }
        return $object;

    }
}