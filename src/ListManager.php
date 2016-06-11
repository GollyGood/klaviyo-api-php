<?php

namespace Klaviyo;

use Klaviyo\Model\ListModel;

class ListManager {

  protected $api;
  protected $resourcePrefix = '/api/v1/';

  public function __construct(KlaviyoApi $api) {
    $this->api = $api;
  }

  public function getResourcePath($resource) {
    return $this->resourcePrefix . $resource;
  }

  public function getAllLists() {
    $list_page = $this->getListPage();

    $lists = $list_page['data'];
    while (count($lists) < $list_page['total']) {
      $list_page = $this->getListPage($list_page['page'] + 1);
      $lists = array_merge($lists, $list_page['data']);
    }

    return $lists;
  }

  public function getListPage($page = 0, $count = 0) {
    $options = ['query' => ['page' => $page, 'count' => $count]];
    $response = $this->api->request('GET', $this->getResourcePath('lists'), $options);
    $body = json_decode($response->getBody(), TRUE);

    if (!empty($body['data'])) {
      foreach ($body['data'] as $data) {
        $lists[] = new ListModel($data);
      }
    }

    $body['data'] = $lists;

    return $body;
  }

}
