<?php


namespace Ipresso\Repository;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Ipresso\Domain\Activity;
use Ipresso\Factory\DomianObjectFactory;

class ActivityRepository
{

    private Client $client;

    private DomianObjectFactory $hydrator;

    /**
     * ActivityRepository constructor.
     * @param Client $client
     * @param DomianObjectFactory $hydrator
     */
    public function __construct(Client $client, DomianObjectFactory $hydrator)
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }

    public function getByKey(string $key): ?Activity
    {
        /** @var  $response Response */
        $response = $this->client->get('api/2/activity');

        $body = json_decode((string)$response->getBody(), true);

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody(), true);
           // dump($body);
            foreach ($body['data']['activity'] as $id => $data) {
                if ($data['key'] === $key) {
                    return $this->hydrator->factory($data, Activity::class);
                }
            }
        }

        return null;
    }

    public function getAll(): array
    {

        /** @var  $response Response */
        $response = $this->client->get('api/2/activity');

        $out = [];

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody(), true);
            foreach ($body['data']['activity'] as $id => $data) {
                $out[] = $this->hydrator->factory($data, Activity::class);
            }
        }

        return $out;

    }


}