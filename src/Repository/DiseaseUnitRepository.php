<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Exception;
use Ipresso\Domain\DiseaseUnit;
use Ipresso\Hydrator\AttributeHydrator;

class DiseaseUnitRepository implements DiseaseUnitRepositoryInterface
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
//dd($apiAttribute);
        if (!isset($apiAttribute->getAttribute()->DiseaseUnit)) {
            throw new Exception('barak atrybutu');
        }
        $this->hydrator = $hydrator;
        $this->apiAttribute = $apiAttribute->getAttribute()->DiseaseUnit;
    }


    public function getByKey( $key ): DiseaseUnit
    {
        foreach ($this->apiAttribute->optionsByKey as $k => $v) {
            if ($k == $key) {
                return $this->hydrator->hydrate([
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->options->{$v}
                ], new DiseaseUnit);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getById( $id ): DiseaseUnit
    {
        foreach ($this->apiAttribute->optionsByKey as $k => $v) {
            if ($id == $v) {
                return $this->hydrator->hydrate([
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->options->{$v}
                ], new DiseaseUnit);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }
}