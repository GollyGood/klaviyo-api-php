<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ObjectId;
use Klaviyo\Model\PersonModel;
use Klaviyo\PersonService;

class PersonServiceTest extends KlaviyoTestCase
{
    protected $responsePerson = [
        'object' => 'person',
        'id' => 'dqQnNW',
        '$email' => 'george.washington@example.com',
        '$first_name' => 'George',
        '$last_name' => 'Washington',
        '$organization' => 'U.S. Government',
        '$title' => 'President',
        '$city' => 'Mount Vernon',
        '$region' => 'Virginia',
        '$zip' => '22121',
        '$country' => 'United States',
        '$timezone' => 'US/Eastern',
        '$phone_number' => '',
    ];
    private $responseUpdate;

    protected function setUp()
    {
        parent::setUp();

        $this->responseUpdate = $this->responsePerson;

        $this->responseUpdate['$title'] = 'Ex-President';
    }

    public function getPersonService(&$container, $responses)
    {
        $api = $this->getApi($this->apiKey, [], $container, $responses);
        return new PersonService($api);
    }

    public function testGetPerson()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responsePerson));
        $person_manager = $this->getPersonService($container, $responses);
        $person = $person_manager->getPerson(new ObjectId('abc'));

        $this->assertTrue($person instanceof PersonModel, 'The person manager should had returned an instance of a PersonModel.');

        $response_person = PersonModel::create($this->responsePerson);
        $this->assertEquals($response_person, $person);
    }

    public function testUpdatePerson()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseUpdate));
        $personService = $this->getPersonService($container, $responses);
        $person = $personService->updatePerson(new ObjectId('abc'), [
            '$title' => 'Ex-President'
        ]);

        $this->assertTrue($person instanceof PersonModel, 'The person manager should had returned an instance of a PersonModel.');

        $response_person = PersonModel::create($this->responseUpdate);
        $this->assertEquals($response_person, $person);
    }
}
