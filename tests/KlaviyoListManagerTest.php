<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Klaviyo\ListManager;
use Klaviyo\Model\ListModel;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class KlaviyoListManagerTest extends KlaviyoTestCase {

  protected $listManager;
  protected $requestPageOne;
  protected $requestPageTwo;

  public function setUp() {
    $this->requestPageZero = [
      'object' => '$list',
      'start' => 0,
      'end' => 1,
      'page_size' => 2,
      'total' => 4,
      'page' => 0,
      'data' => [
        [
          'id' => 'arY8wg',
          'name' => 'List 1',
          'object' => 'list',
          'list_type' => 'list',
          'folder' => NULL,
          'created' => '2016-01-01 18:58:54',
          'updated' => '2016-01-02 06:00:00',
          'person_count' => 1,
        ],
        [
          'id' => 'arY1wg',
          'name' => 'List 1',
          'object' => 'list',
          'list_type' => 'segment',
          'folder' => [
            'object' => 'folder',
            'id' => 12345,
            'name' => 'Ideas & Inspiration'
          ],
          'created' => '2016-01-01 18:58:54',
          'updated' => '2016-01-02 06:00:00',
          'person_count' => 0,
        ],
      ]
    ];
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->requestPageZero));
    $this->requestPageOne = $this->requestPageZero;
    $this->requestPageOne['start'] = 2;
    $this->requestPageOne['end'] = 3;
    $this->requestPageOne['page'] = 1;
    $responses[] = new Response(200, [], json_encode($this->requestPageOne));

    $client = $this->getClient($container, $responses);
    $api = new KlaviyoApi($client, 'asdf');
    $this->listManager = new ListManager($api);
  }

  public function assertListAreSame($raw) {
  }

  public function testGetListPage() {
    $list_page_zero = $this->listManager->getListPage(0);
    $list_page_one = $this->listManager->getListPage(1);

    $this->assertCount(2, $list_page_one['data'], 'There should be two records.');
    $this->assertSame(4, $list_page_one['total'], 'There should be a total of 4 list records available.');
    $this->assertSame(2, $list_page_one['start'], 'It should had started at the 3rd record.');
    $this->assertSame(3, $list_page_one['end'], 'It should had ended at the 4th record.');
    $this->assertSame(1, $list_page_one['page'], 'It should had been on the 2nd page.');

    $list_two = new ListModel($this->requestPageOne['data'][0]);
    $this->assertEquals($list_two, $list_page_one['data'][0]);
    $list_three = new ListModel($this->requestPageOne['data'][1]);
    $this->assertEquals($list_three, $list_page_one['data'][1]);
  }

  public function testGetAllLists() {
    $lists = $this->listManager->getAllLists();

    $this->assertCount(4, $lists);

    $listZero = new ListModel($this->requestPageZero['data'][0]);
    $this->assertEquals($listZero, $lists[0]);
    $listOne = new ListModel($this->requestPageZero['data'][1]);
    $this->assertEquals($listOne, $lists[1]);
    $listTwo = new ListModel($this->requestPageOne['data'][0]);
    $this->assertEquals($listTwo, $lists[2]);
    $listThree = new ListModel($this->requestPageOne['data'][1]);
    $this->assertEquals($listThree, $lists[3]);
  }

}
