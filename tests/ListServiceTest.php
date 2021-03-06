<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\ListService;
use Klaviyo\Model\ListModel;
use Klaviyo\Model\ExcludedFromListModel;
use Klaviyo\Model\ExclusionModel;
use Klaviyo\Model\ListReferenceModel;
use Klaviyo\Model\MembershipModel;
use Klaviyo\Model\PersonListModel;
use Klaviyo\Model\PeopleListModel;
use Klaviyo\Model\PersonModel;
use Klaviyo\Model\PersonReferenceModel;
use Klaviyo\Model\ObjectId;

class ListServiceTest extends KlaviyoTestCase
{
    protected $responseListZero;
    protected $responseListOne;
    protected $responsePageZero;
    protected $responsePageOne;
    protected $responseListMembers;
    protected $responseAddListPerson;
    protected $responseAddListPeople;
    protected $responseListExcludePerson;
    protected $responseExclusionsResponsePageZero;
    protected $responseExclusionsResponsePageOne;

    public function setUp()
    {
        $this->responseListZero = [
            'object' => 'list',
            'id' => 'arY8wg',
            'name' => 'List 1',
            'list_type' => 'list',
            'folder' => null,
            'created' => '2016-01-01 18:58:54',
            'updated' => '2016-01-02 06:00:00',
            'person_count' => 1,
        ];

        $this->responseListOne = [
            'object' => 'list',
            'id' => 'arY1wg',
            'name' => 'List 1',
            'list_type' => 'segment',
            'folder' => [
                'object' => 'folder',
                'id' => 12345,
                'name' => 'Ideas & Inspiration',
            ],
            'created' => '2016-01-01 18:58:54',
            'updated' => '2016-01-02 06:00:00',
            'person_count' => 0,
        ];

        $this->responsePageZero = [
            'object' => '$list',
            'start' => 0,
            'end' => 1,
            'page_size' => 2,
            'total' => 4,
            'page' => 0,
            'data' => [
                $this->responseListZero,
                $this->responseListOne,
            ],
        ];
        $this->responsePageOne = $this->responsePageZero;
        $this->responsePageOne['start'] = 2;
        $this->responsePageOne['end'] = 3;
        $this->responsePageOne['page'] = 1;

        $this->responseListMembers = [
            'object' => '$list',
            'start' => 0,
            'end' => 1,
            'page' => 0,
            'page_size' => 2,
            'total' => 2,
            'data' => [
                [
                    'object' => 'membership',
                    'email' => 'george.washington@example.com',
                    'date_added' => '2013-06-10 13:00:00',
                    'person' => [
                        'object' => 'person',
                        'id' => '0mzwQ7',
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
                    ],
                ],
                [
                    'object' => 'membership',
                    'email' => 'thomas.jefferson@example.com',
                    'date_added' => '2013-06-10 13:00:00',
                    'person' => [
                        'object' => 'person',
                        'id' => '4UaYpQ',
                        '$email' => 'thomas.jefferson@example.com',
                        '$first_name' => 'Thomas',
                        '$last_name' => 'Jefferson',
                        '$organization' => 'U.S. Government',
                        '$title' => 'President',
                        '$city' => 'Charlottesville',
                        '$region' => 'Virginia',
                        '$zip' => '22902',
                        '$country' => 'United States',
                        '$timezone' => 'US/Eastern',
                        '$phone_number' => '',
                    ],
                ],
            ],
        ];

        $this->responseAddListPerson = [
            'person' => [
                'object' => 'person',
                'id' => 'erRoOX',
                'email' => 'george.washington.@example.com',
            ],
            'list' => [
                'object' => 'list',
                'id' => 'arY8wg',
                'name' => 'List 1',
            ],
            'already_member' => true,
        ];
        // Note that this is different from the documentation as this is the
        // actual response provided.
        $this->responseAddListPeople = [
            'people' => [
                [
                  'email' => 'george.washington@example.com',
                  'already_member' => true,
                ],
                [
                  'email' => 'thomas.jefferson@example.com',
                  'already_member' => false,
                ]
            ],
            'list' => [
                'object' => 'list',
                'id' => 'arY8wg',
                'name' => 'List 1',
            ]
        ];

        $this->responseListExcludePerson = [
            'already_excluded' => false,
            'num_excluded' => 1,
        ];

        $this->responseExclusionsResponsePageZero = [
            'end' => 1,
            'object' => '$list',
            'page_size' => 1,
            'start' => 0,
            'total' => 2,
            'data' => [
                [
                    'timestamp' => '2018-04-06 13:26:58',
                    'reason' => 'unsubscribed',
                    'object' => 'exclusion',
                    'email' => 'george.washington@example.com'
                ]
            ],
            'page' => 0
        ];

        $this->responseExclusionsResponsePageOne = $this->responseExclusionsResponsePageZero;
        $this->responseExclusionsResponsePageOne['start'] = 2;
        $this->responseExclusionsResponsePageOne['end'] = 1;
        $this->responseExclusionsResponsePageOne['page'] = 1;
        $this->responseExclusionsResponsePageOne['data'] = [
              [
                  'timestamp' => '2018-04-06 13:26:58',
                  'reason' => 'unsubscribed',
                  'object' => 'exclusion',
                  'email' => 'thomas.jeffereson@example.com'
              ]
        ];
    }

    public function getMultiPageListService()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responsePageZero));
        $responses[] = new Response(200, [], json_encode($this->responsePageOne));

        return $this->getListService($container, $responses);
    }

    public function getListService(&$container, $responses)
    {
        $api = $this->getApi($this->apiKey, [], $container, $responses);
        return new ListService($api);
    }

    public function testGetListPage()
    {
        $list_manager = $this->getMultiPageListService();
        $lists = $list_manager->getListsFromPage();

        $this->assertCount(2, $lists, 'There should be two records.');

        $list_zero = new ListModel($this->responsePageZero['data'][0]);
        $this->assertEquals($list_zero, $lists[0]);
        $list_one = new ListModel($this->responsePageZero['data'][1]);
        $this->assertEquals($list_one, $lists[1]);
    }

    public function testGetAllLists()
    {
        $list_manager = $this->getMultiPageListService();
        $lists = $list_manager->getAllLists();

        $this->assertCount(4, $lists);

        $listZero = new ListModel($this->responsePageZero['data'][0]);
        $this->assertEquals($listZero, $lists[0]);
        $listOne = new ListModel($this->responsePageZero['data'][1]);
        $this->assertEquals($listOne, $lists[1]);
        $listTwo = new ListModel($this->responsePageOne['data'][0]);
        $this->assertEquals($listTwo, $lists[2]);
        $listThree = new ListModel($this->responsePageOne['data'][1]);
        $this->assertEquals($listThree, $lists[3]);
    }

    public function testGetListById()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListZero));
        $list_manager = $this->getListService($container, $responses);
        $listZero = new ListModel($this->responseListZero);
        $this->assertEquals($listZero, $list_manager->getList(new ObjectId($this->responseListZero['id'])));
    }

    public function testCreateNewList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListZero));
        $list_manager = $this->getListService($container, $responses);
        $new_list = $list_manager->createList($this->responseListZero['name']);

        $listZero = new ListModel($this->responseListZero);
        $this->assertEquals($listZero, $new_list);

        $request = $container[0]['request'];

        $this->assertSame('POST', $request->getMethod());

        $fields = array();
        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame(
            $this->responseListZero['name'],
            $fields['name']
        );
        $this->assertSame('list', $fields['list_type']);
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testUpdateList()
    {
        $container = $responses = [];
        $updated_response_list = $this->responseListZero;
        $updated_response_list['name'] = 'Changed name';
        $responses[] = new Response(200, [], json_encode($updated_response_list));
        $list_manager = $this->getListService($container, $responses);

        $list = new ListModel($this->responseListZero);
        $list->name = 'Changed name';
        $list = $list_manager->updateList($list);

        $listZero = new ListModel($updated_response_list);
        $this->assertEquals($listZero, $list);

        $request = $container[0]['request'];
        $fields = array();
        $this->assertSame($this->endPoint . "/api/v1/list/{$this->responseListZero['id']}", (string) $request->getUri(), 'The request URI should include the resource and api key.');
        $this->assertSame('PUT', $request->getMethod());

        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame('Changed name', $fields['name']);
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testDeleteList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListZero));
        $list_manager = $this->getListService($container, $responses);

        $list = new ListModel($this->responseListZero);
        $list = $list_manager->deleteList($list);

        $listZero = new ListModel($this->responseListZero);
        $this->assertEquals($listZero, $list);

        $request = $container[0]['request'];
        $this->assertSame('DELETE', $request->getMethod());

        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testCheckMembersAreInList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListMembers));
        $list_manager = $this->getListService($container, $responses);
        $list = new ListModel($this->responseListZero);
        $members = $list_manager->checkMembersAreInList($list, ['george.washington@example.com', 'thomas.jefferson@example.com']);

        $this->assertCount(2, $members);
        foreach ($members as $member) {
            $this->assertTrue($member instanceof MembershipModel, 'The returned person objects should be an instance of a MembershipModel.');
        }

        $request = $container[0]['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://a.klaviyo.com/api/v1/list/arY8wg/members?email=george.washington%40example.com%2Cthomas.jefferson%40example.com&api_key=asdf', (string) $request->getUri());
    }

    public function testCheckMembersAreInSegment()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListMembers));
        $list_manager = $this->getListService($container, $responses);
        $list = new ListModel($this->responseListOne);
        $members = $list_manager->checkMembersAreInSegment($list, ['george.washington@example.com', 'thomas.jefferson@example.com']);

        $this->assertCount(2, $members);
        foreach ($members as $member) {
            $this->assertTrue($member instanceof MembershipModel, 'The returned person objects should be an instance of a MembershipModel.');
        }

        $request = $container[0]['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://a.klaviyo.com/api/v1/segment/arY1wg/members?email=george.washington%40example.com%2Cthomas.jefferson%40example.com&api_key=asdf', (string) $request->getUri());
    }

    public function testAddPersonToList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseAddListPerson));
        $list_manager = $this->getListService($container, $responses);
        $list = new ListModel($this->responseListZero);
        $person = PersonModel::create(['$first_name' => 'George', 'Birthday' => '02/22/1732', '$email' => 'george.washington@example.com']);
        $person_list = $list_manager->addPersonToList($list, $person);

        $this->assertTrue($person_list instanceof PersonListModel, 'The returned object should be an instance of PersonListModel.');
        $person_reference = PersonReferenceModel::create($this->responseAddListPerson['person']);
        $this->assertEquals($person_reference, $person_list->person);
        $list_reference = ListReferenceModel::create($this->responseAddListPerson['list']);
        $this->assertEquals($list_reference, $person_list->list);
        $this->assertTrue($person_list->alreadyMember);

        $request = $container[0]['request'];
        $this->assertSame('POST', $request->getMethod());
        $fields = [];
        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame('george.washington@example.com', $fields['email']);
        $this->assertEquals($person, PersonModel::createFromJson($fields['properties']));
        $this->assertTrue((bool) $fields['confirm_optin']);
    }

    public function testAddPeopleToList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseAddListPeople));
        $list_manager = $this->getListService($container, $responses);
        $list = new ListModel($this->responseListZero);
        $people = [
            PersonModel::create(['$first_name' => 'George', 'Birthday' => '02/22/1732', '$email' => 'george.washington@example.com']),
            PersonModel::create(['$first_name' => 'Thomas', 'Birthday' => '04/13/1743', '$email' => 'thomas.jefferson@example.com']),
        ];
        $people_list = $list_manager->addPeopleToList($list, $people);
        $this->assertTrue($people_list instanceof PeopleListModel, 'The returned object should be an instance of PeopleListModel.');
        $people_references = [
            [
                'email' => $this->responseAddListPeople['people'][0]['email'],
                'already_member' => true,
            ],
            [
                'email' => $this->responseAddListPeople['people'][1]['email'],
                'already_member' => false,
            ]
        ];
        $this->assertEquals($people_references, $people_list->people);

        $list_reference = ListReferenceModel::create($this->responseAddListPeople['list']);
        $this->assertEquals($list_reference, $people_list->list);

        $request = $container[0]['request'];
        $this->assertSame('POST', $request->getMethod());
        $fields = [];
        parse_str(urldecode((string) $request->getBody()), $fields);

        $batch = json_decode($fields['batch'], true);
        $this->assertSame('george.washington@example.com', $batch[0]['email']);
        $this->assertSame('thomas.jefferson@example.com', $batch[1]['email']);
        $this->assertEquals($people[0], PersonModel::create($batch[0]['properties']));
        $this->assertEquals($people[1], PersonModel::create($batch[1]['properties']));
        $this->assertTrue((bool) $fields['confirm_optin']);
    }

    public function testExcludePersonFromList()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListExcludePerson));
        $list_manager = $this->getListService($container, $responses);
        $list = new ListModel($this->responseListZero);
        $person = PersonModel::create(['$first_name' => 'George', 'Birthday' => '02/22/1732', '$email' => 'george.washington@example.com']);

        $excluded = $list_manager->excludePersonFromList($list, $person);
        $this->assertTrue($excluded instanceof ExcludedFromListModel, 'The returned object should be an instance of ExcludedFromListModel.');

        $excluded_from_list = ExcludedFromListModel::create($this->responseListExcludePerson);
        $this->assertEquals($excluded_from_list, $excluded);

        $this->assertFalse($excluded->alreadyExcluded);
        $this->assertSame(1, $excluded->numExcluded);
    }

    public function testGetListExclusionsPage()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageOne));
        $list_manager = $this->getListService($container, $responses);

        $exclusions = $list_manager->getListExclusionsFromPage(new ObjectId('arY8wg'), 1);

        $list_one = new ExclusionModel($this->responseExclusionsResponsePageOne['data'][0]);
        $this->assertEquals($list_one, $exclusions[0]);
    }

    public function testGetAllListExclusions()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageZero));
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageOne));
        $list_manager = $this->getListService($container, $responses);

        $list = new ListModel($this->responseListZero);
        $exclusions = $list_manager->getAllListExclusions($list);
        $this->assertCount(2, $exclusions, 'There should be two records');

        $exclusionZero = new ExclusionModel($this->responseExclusionsResponsePageZero['data'][0]);
        $this->assertEquals($exclusionZero, $exclusions[0]);
        $exclusionOne = new ExclusionModel($this->responseExclusionsResponsePageOne['data'][0]);
        $this->assertEquals($exclusionOne, $exclusions[1]);
    }

    public function testGetExclusionsPage()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageOne));
        $list_manager = $this->getListService($container, $responses);

        $exclusions = $list_manager->getExclusionsFromPage(1);

        $list_one = new ExclusionModel($this->responseExclusionsResponsePageOne['data'][0]);
        $this->assertEquals($list_one, $exclusions[0]);
    }

    public function testGetAllExclusions()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageZero));
        $responses[] = new Response(200, [], json_encode($this->responseExclusionsResponsePageOne));
        $list_manager = $this->getListService($container, $responses);

        $exclusions = $list_manager->getAllExclusions();
        $this->assertCount(2, $exclusions, 'There should be two records');

        $exclusionZero = new ExclusionModel($this->responseExclusionsResponsePageZero['data'][0]);
        $this->assertEquals($exclusionZero, $exclusions[0]);
        $exclusionOne = new ExclusionModel($this->responseExclusionsResponsePageOne['data'][0]);
        $this->assertEquals($exclusionOne, $exclusions[1]);
    }

    public function testExcludePersonFromAllEmail()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseListExcludePerson));
        $list_manager = $this->getListService($container, $responses);
        $person = PersonModel::create(['$first_name' => 'George', 'Birthday' => '02/22/1732', '$email' => 'george.washington@example.com']);

        $excluded = $list_manager->excludePersonFromAllEmail($person);
        $this->assertTrue($excluded instanceof ExcludedFromListModel, 'The returned object should be an instance of ExcludedFromListModel.');

        $excluded_from_list = ExcludedFromListModel::create($this->responseListExcludePerson);
        $this->assertEquals($excluded_from_list, $excluded);

        $this->assertFalse($excluded->alreadyExcluded);
        $this->assertSame(1, $excluded->numExcluded);
    }


}
