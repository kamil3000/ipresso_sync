<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 15:40
 */

namespace Ipresso\Repository;


use Exception;
use Ipresso\Domain\SourceOfAddition;
use Ipresso\Hydrator\AttributeHydrator;

class SourceOfAdditionRepository implements SourceOfAdditionRepositoryInterface
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

        if (!isset($apiAttribute->getAttribute()->SourceOfAddition)) {
            throw new Exception('barak atrybutu SourceOfAddition');
        }

        $this->hydrator = $hydrator;
        $this->apiAttribute = $apiAttribute->getAttribute()->SourceOfAddition;
    }


    public function getByKey($key): SourceOfAddition
    {
//        if(isset($_COOKIE['dev'])){
//            print_r($this->apiAttribute->optionsByKey);
//            exit;
//        }
        foreach ($this->apiAttribute->optionsByKey as $k => $v) {
            if ($k == $key) {
                return $this->hydrator->hydrate([
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->options->{$v}
                ], new SourceOfAddition);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getByName(string $sName): SourceOfAddition
    {


        foreach ($this->apiAttribute->options as $id => $name) {
            if ($sName == $name) {
                return $this->getById($id);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu: "SourceOfAddition" ');

        // TODO: Implement getByName() method.
    }

    public function getById($sId): SourceOfAddition
    {
        foreach ($this->apiAttribute->optionsByKey as $key => $id) {
            if ($sId == $id) {
                return $this->hydrator->hydrate([
                    'id' => $id,
                    'key' => $key,
                    'name' => $this->apiAttribute->options->{$id}
                ], new SourceOfAddition);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }
}