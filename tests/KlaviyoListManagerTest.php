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
    $client = $this->getClient($container, $responses);
    $api = new KlaviyoApi($client, $this->apiKey);
    $list_manager = new ListManager($api);
    $listZero = new ListModel($this->responseListZero);
    $this->assertEquals($listZero, $list_manager->getList($this->responseListZero['id']));
  }

}
