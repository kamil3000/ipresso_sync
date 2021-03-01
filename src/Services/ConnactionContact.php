<?php

namespace Ipresso\Services;


use Ipresso\Api\Correspondent;
use Ipresso\Domain\Contact;

class ConnactionContact
{
    private Correspondent $correspondent;

    /**
     * ConnactionContact constructor.
     * @param Correspondent $correspondent
     */
    public function __construct(Correspondent $correspondent)
    {
        $this->correspondent = $correspondent;
    }


    public function exec(Contact $contactMaster, Contact $contactSlave): bool
    {
        $response = $this->correspondent->connactionContact($contactMaster->getIdContact(), $contactSlave->getIdContact());

        return $response->getStatusCode() === 201;

    }


}