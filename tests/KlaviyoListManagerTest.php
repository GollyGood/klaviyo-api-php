<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Klaviyo\ListManager;
use Klaviyo\Model\ListModel;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class KlaviyoListManagerTest extends KlaviyoTestCase {

  protected $apiKey = 'asdf';
  protected $listManager;
  protected $responsePageOne;
  protected $responsePageTwo;

  public function setUp() {
    $this->responseListZero = [
      'id' => 'arY8wg',
      'name' => 'List 1',
      'object' => '$list',
      'list_type' => 'list',
      'folder' => NULL,
      'created' => '2016-01-01 18:58:54',
      'updated' => '2016-01-02 06:00:00',
      'person_count' => 1,
    ];

    $this->responseListOne = [
      'id' => 'arY1wg',
      'name' => 'List 1',
      'object' => '$list',
      'list_type' => 'segment',
      'folder' => [
        'object' => 'folder',
        'id' => 12345,
        'name' => 'Ideas & Inspiration'
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
      ]
    ];
    $this->responsePageOne = $this->responsePageZero;
    $this->responsePageOne['start'] = 2;
    $this->responsePageOne['end'] = 3;
    $this->responsePageOne['page'] = 1;
  }

  public function getMultiPageListManager() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->responsePageZero));
    $responses[] = new Response(200, [], json_encode($this->responsePageOne));

    return $this->getListManager($container, $responses);
  }

  public function getListManager(&$container, $responses) {
    $client = $this->getClient($container, $responses);
    $api = new KlaviyoApi($client, $this->apiKey);
    return new ListManager($api);
  }

  public function testGetListPage() {
    $list_manager = $this->getMultiPageListManager();
    $lists = $list_manager->getListsFromPage($list_manager->getResourcePath('list'));

    $this->assertCount(2, $lists, 'There should be two records.');

    $list_zero = new ListModel($this->responsePageZero['data'][0]);
    $this->assertEquals($list_zero, $lists[0]);
    $list_one = new ListModel($this->responsePageZero['data'][1]);
    $this->assertEquals($list_one, $lists[1]);
  }

  public function testGetAllLists() {
    $list_manager = $this->getMultiPageListManager();
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

  public function testGetListById() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->responseListZero));
    $list_manager = $this->getListManager($container, $responses);
    $listZero = new ListModel($this->responseListZero);
    $this->assertEquals($listZero, $list_manager->getList($this->responseListZero['id']));
  }

  public function testCreateNewList() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->responseListZero));
    $list_manager = $this->getListManager($container, $responses);
    $new_list = $list_manager->createList($this->responseListZero['name']);

    $listZero = new ListModel($this->responseListZero);
    $this->assertEquals($listZero, $new_list);

    $request = $container[0]['request'];
    $this->assertSame('POST', $request->getMethod());

    $fields = array();
    parse_str(urldecode((string) $request->getBody()), $fields);
    $this->assertSame($this->responseListZero['name'], $fields['name']);
    $this->assertSame('list', $fields['list_type']);
    $this->assertSame($this->apiKey, $fields['api_key']);
  }

  public function testUpdateList() {
    $container = $responses = [];
    $updated_response_list = $this->responseListZero;
    $updated_response_list['name'] = 'Changed name';
    $responses[] = new Response(200, [], json_encode($updated_response_list));
    $list_manager = $this->getListManager($container, $responses);

    $list = new ListModel($this->responseListZero);
    $list->setName('Changed name');
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

  public function testDeleteList() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->responseListZero));
    $list_manager = $this->getListManager($container, $responses);

    $list = new ListModel($this->responseListZero);
    $list = $list_manager->deleteList($list);

    $listZero = new ListModel($this->responseListZero);
    $this->assertEquals($listZero, $list);

    $request = $container[0]['request'];
    $this->assertSame('DELETE', $request->getMethod());

    parse_str(urldecode((string) $request->getBody()), $fields);
    $this->assertSame($this->apiKey, $fields['api_key']);
  }

}
