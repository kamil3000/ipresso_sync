<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Exception;
use Ipresso\Domain\ContactAttributeArrayOption;
use Ipresso\Hydrator\AttributeHydrator;
use Ipresso\Hydrator\ContactHydrator;

class AttributeOptionRepository implements AttributeOptionRepositoryInterface
{
    private $apiAttribute;

    /**
     * DiseaseUnitRepository constructor.
     * @param ApiAttribute $apiAttribute
     */
    public function __construct(ApiAttribute $apiAttribute, private readonly AttributeHydrator $hydrator)
    {
        $this->apiAttribute = $apiAttribute->getAttribute();
    }

    public function getByName($attr, $key ): ContactAttributeArrayOption
    {

        foreach ($this->apiAttribute->{$attr}->options as $k => $v) {
            if ($v == $key) {

                return $this->getById($attr,$k);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getByKey($attr, $key ): ContactAttributeArrayOption
    {

        foreach ($this->apiAttribute->{$attr}->optionsByKey as $k => $v) {
            if ($k == $key) {
                return $this->hydrator->hydrate([
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->{$attr}->options->{$v}
                ]);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getById($attr, $id ): ContactAttributeArrayOption
    {
        foreach ($this->apiAttribute->{$attr}->optionsByKey as $k => $v) {
            if ($id == $v) {
                return $this->hydrator->hydrate([
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->{$attr}->options->{$v}
                ]);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }
}