<?php


namespace Ipresso\Repository;


use GuzzleHttp\Psr7\Response;
use Ipresso\Domain\Contact;
use Ipresso\Domain\Tag;
use GuzzleHttp\Client;
use Ipresso\Factory\DomianObjectFactory;

class TagRepository
{
    /** @var Client */
    private $client;

    /** @var AttributeHydrator */
    private $hydrator;

    /**
     * TagRepository constructor.
     * @param Client $client
     * @param AttributeHydrator $hydrator
     */
    public function __construct(Client $client, DomianObjectFactory $hydrator)
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }

    public function tagAContact(Tag $tag , Contact $contact){
        $body['contact'][] = $contact->getIdContact();

        /** @var  $response Response */
        $response = $this->client->post('api/2/tag/'. $tag->getId() . '/contact', array(
            'form_params' => $body
        ));

    }

    public function add(Tag $tag)
    {
        if ($tag->getId() !== null) {
            throw new \Exception('cannot contain id');
        }
        
        /** @var  $response Response */
        $response = $this->client->post('api/2/tag', array(
            'form_params' => [
                'name' => $tag->getName()
            ]
        ));

        if ($response->getStatusCode() === 201) {
            $rb = json_decode((string)$response->getBody());

            $this->hydrator->marge([
                'id' => $rb->data->tag->id,
                'name' => $rb->data->tag->name
            ], $tag);
        }

        if ($response->getStatusCode() === 302) {
            throw new \Ipresso\Repository\Exception\AlreadyExistsException();
        }

    }

    public function getByName(string $name): ?Tag
    {
        /** @var Tag $tag */
        foreach ($this->getAll() as $tag) {
            if ($name === $tag->getName()) {
                return $tag;
            }
        }
        return null;
    }

    public function getById(int $id): ?Tag
    {
        /** @var  $response Response */
        $response = $this->client->get('api/2/tag/' . $id);

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());
            $o = (array)$body->data->tag;
            return $this->hydrator->factory([
                'id' => key($o),
                'name' => $o[key($o)]
            ], Tag::class);
        }

        return null;
    }

    public function getAll(): array
    {

        /** @var  $response Response */
        $response = $this->client->get('api/2/tag');

        $out = [];

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());
            foreach ($body->data->tag as $id => $name) {
                $out[] = $this->hydrator->factory([
                    'id' => $id,
                    'name' => $name
                ], Tag::class);
            }
        }

        return $out;

    }
}