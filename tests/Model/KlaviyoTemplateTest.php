<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\PageModel;
use Klaviyo\Model\ModelInterface;
use Psr\Http\Message\ResponseInterface;

class KlaviyoTemplateTest extends KlaviyoBaseTest {

  protected $class = 'Klaviyo\Model\TemplateModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = [
      'object' => 'email-template',
      'id' => 'dqQnNW',
      'name' => 'My New Template',
      'html' => '<html><body><p>This is an email for {{ email }}.</p></body></html>',
      'created' => '2013-06-17 14:00:00',
      'updated' => '2013-06-17 14:00:00',
    ];
  }

  public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }

    $this->assertSame($this->configuration['object'], $model->objectType);
    $this->assertSame($this->configuration['id'], $model->id);
    $this->assertSame($this->configuration['name'], $model->name);
    $created = new \DateTime($configuration['created']);
    $this->assertEquals($created, $model->created);
    $updated = new \DateTime($configuration['updated']);
    $this->assertEquals($updated, $model->updated);
    $dom = new \DOMDocument();
    $dom->loadHTML($this->configuration['html']);
    $this->assertEquals($dom, $model->html);
  }

}
