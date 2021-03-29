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

    /** @var ContactHydrator */
    private $hydrator;

    /**
     * DiseaseUnitRepository constructor.
     * @param ApiAttribute $apiAttribute
     */
    public function __construct(ApiAttribute $apiAttribute, AttributeHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
        $this->apiAttribute = $apiAttribute->getAttribute();
    }

    public function getByKey($attr, $key ): ContactAttributeArrayOption
    {

        foreach ($this->apiAttribute->{$attr}->optionsByKey as $k => $v) {
            if ($k == $key) {
                return $this->hydrator->hydrate(array(
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->{$attr}->options->{$v}
                ), new ContactAttributeArrayOption);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getById($attr, $id ): ContactAttributeArrayOption
    {
        foreach ($this->apiAttribute->{$attr}->optionsByKey as $k => $v) {
            if ($id == $v) {
                return $this->hydrator->hydrate(array(
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->{$attr}->options->{$v}
                ), new ContactAttributeArrayOption);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }
}