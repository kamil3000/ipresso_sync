<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Exception;
use Ipresso\Domain\Registration;
use Ipresso\Hydrator\AttributeHydrator;

class RegistrationRepository implements RegistrationRepositoryInterface
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
        if (!isset($apiAttribute->getAttribute()->Registration)) {
            throw new Exception('barak atrybutu');
        }
        $this->hydrator = $hydrator;
        //  echo "<pre>".print_r($apiAttribute->getAttribute(),true)."</pre>";exit;
        $this->apiAttribute = $apiAttribute->getAttribute()->Registration;
    }


    public function getByKey( $key ): Registration
    {
        foreach ($this->apiAttribute->optionsByKey as $k => $v) {
            if ($k == $key) {
                return $this->hydrator->hydrate(array(
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->options->{$v}
                ), new Registration);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }

    public function getById( $id ): DiseaseUnit
    {
        foreach ($this->apiAttribute->optionsByKey as $k => $v) {
            if ($id == $v) {
                return $this->hydrator->hydrate(array(
                    'id' => $v,
                    'key' => $k,
                    'name' => $this->apiAttribute->options->{$v}
                ), new DiseaseUnit);
            }
        }

        throw new NotFoundException('nie znaleziono atrybutu');
    }
}