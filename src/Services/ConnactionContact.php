<?php

namespace Ipresso\Services;


use Ipresso\Api\Correspondent;
use Ipresso\Domain\Contact;

readonly class ConnactionContact
{
    /**
     * ConnactionContact constructor.
     * @param Correspondent $correspondent
     */
    public function __construct(private Correspondent $correspondent)
    {
    }


    public function exec(Contact $contactMaster, Contact $contactSlave): bool
    {
        $response = $this->correspondent->connactionContact($contactMaster->getIdContact(), $contactSlave->getIdContact());

        return $response->getStatusCode() === 201;

    }


}