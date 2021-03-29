<?php


namespace Ipresso\Factory;

use Ipresso\Domain\AbstractCollection;
use ReflectionClass;

class DomianObjectFactory
{

    private $storage = [];

    public function factory(array $data, string $className)
    {
        $id = null;

        if (isset($data['id'])) {
            $id = $data['id'];
        }

        if ($id === null) {
            return $this->hydrate($data, new $className);
        }

        if (!isset($storage[$className]) || !isset($storage[$className][$id])) {
            $storage[$className][$id] = $this->hydrate($data, new $className);
        }

        return $storage[$className][$id];
    }

    public function marge(array $data, $object)
    {
        $this->hydrate($data, $object);
    }

    private function hydrate(array $data, $object)
    {
        $properties = (new ReflectionClass($object))->getProperties();

        foreach ($properties as $property) {

            if (isset($data[$property->name])) {
                $property->setAccessible(true);
                $propertyClassName = $property->getType()->getName();
                switch ($propertyClassName) {
                    case 'bool':
                        $property->setValue($object, (bool)$data[$property->name]);
                        break;
                    case 'int' :
                        $property->setValue($object, (int)$data[$property->name]);
                        break;
                    case 'string' :
                        $property->setValue($object, (string)$data[$property->name]);
                        break;
                    default:
                        $propertyClass = null;

                        if (class_exists($propertyClassName)) {
                            $propertyClass = new $propertyClassName();

                            if ($propertyClass instanceof AbstractCollection && is_array($data[$property->name])) {


                                /** @var \ReflectionProperty $propertyClassProperties */
                                $propertyClassProperties = (new ReflectionClass($propertyClass))->getProperty('var');

                                $propertyClassProperties->getDocComment();

                                $collectionItemClassName = trim(str_replace(['/**', '*/', '@var', '[]'], "", $propertyClassProperties->getDocComment()));

                                $collectionItemClassCollection = [];
                                if (class_exists($collectionItemClassName)) {
                                    foreach ($data[$property->name] as $rawCollectionItemKey => $rawCollectionItemValue) {
                                        if(is_array($rawCollectionItemValue)){
                                            $collectionItemClassCollection[] = $this->factory($rawCollectionItemValue, $collectionItemClassName);
                                        }else{
                                            $collectionItemClassCollection[] = $this->factory([
                                                'key' => $rawCollectionItemKey,
                                                'value' => $rawCollectionItemValue
                                            ], $collectionItemClassName);
                                        }
                                    }
                                }

                                if ($collectionItemClassCollection !== []) {
                                    $propertyClassProperties->setAccessible(true);
                                    $propertyClassProperties->setValue($propertyClass, $collectionItemClassCollection);
                                }
                            }
                            $property->setValue($object, $propertyClass);
                        }
                }

            }
        }
        return $object;
    }

}