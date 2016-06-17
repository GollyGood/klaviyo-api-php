<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\PageModel;
use Klaviyo\Model\ModelInterface;
use Psr\Http\Message\ResponseInterface;

class KlaviyoPageTest extends KlaviyoBaseTest {

  protected $class = 'Klaviyo\Model\PageModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = [
      'object' => '$list',
      'start' => 0,
      'end' => 0,
      'page_size' => 0,
      'total' => 0,
      'page' => 0,
      'data' => []
    ];
  }

  public function assertModelMatchesConfiguration(ModelInterface $list, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }
  }

}
