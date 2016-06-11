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
    $this->requestPageOne = $this->requestPageZero;
    $this->requestPageOne['start'] = 2;
    $this->requestPageOne['end'] = 3;
    $this->requestPageOne['page'] = 1;
  }

  public function getMultiPageListManager() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->requestPageZero));
    $responses[] = new Response(200, [], json_encode($this->requestPageOne));

    $client = $this->getClient($container, $responses);
    $api = new KlaviyoApi($client, 'asdf');

    return new ListManager($api);
  }

  public function testGetListPage() {
    $list_manager = $this->getMultiPageListManager();
    $list_page_zero = $list_manager->getListPage();

    $this->assertCount(2, $list_page_zero['data'], 'There should be two records.');
    $this->assertSame(4, $list_page_zero['total'], 'There should be a total of 4 list records available.');
    $this->assertSame(0, $list_page_zero['start'], 'It should had started at the 1st record.');
    $this->assertSame(1, $list_page_zero['end'], 'It should had ended at the 2nd record.');
    $this->assertSame(0, $list_page_zero['page'], 'It should had been on the 1st page.');

    $list_zero = new ListModel($this->requestPageZero['data'][0]);
    $this->assertEquals($list_zero, $list_page_zero['data'][0]);
    $list_one = new ListModel($this->requestPageZero['data'][1]);
    $this->assertEquals($list_one, $list_page_zero['data'][1]);
  }

  public function testGetAllLists() {
    $list_manager = $this->getMultiPageListManager();
    $lists = $list_manager->getAllLists();

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
