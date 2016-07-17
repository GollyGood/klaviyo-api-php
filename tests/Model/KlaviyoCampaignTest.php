<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\ModelInterface;
use Psr\Http\Message\ResponseInterface;

class KlaviyoCampaignTest extends KlaviyoBaseTest {

  protected $class = 'Klaviyo\Model\CampaignModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = [
      'object' => 'campaign',
      'id'=> 'dqQnNW',
      'name' => 'Campaign Name',
      'subject' => 'Company Monthly Newsletter',
      'from_email' => 'george.washington@example.com',
      'from_name' => 'George Washington',
      'list_id' => 'erRoOX',
      'template' => [
        'object' => 'email-template',
        'id' => 'fsSpPY',
        'html' => '<html><body><p>This is the email content</p></body></html>',
      ],
      'status' => 'draft',
      'sent_at' => NULL,
      'created' => '2103-06-14 12:00:00'
    ];
  }

  public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }

    $this->assertSame($this->configuration['object'], $model->objectType);
    $this->assertSame($this->configuration['id'], $model->id);
    $this->assertSame($this->configuration['name'], $model->name);
    $this->assertSame($this->configuration['subject'], $model->subject);
    $this->assertSame($this->configuration['from_email'], $model->fromEmail);
    $this->assertSame($this->configuration['from_name'], $model->fromName);
    $this->assertSame($this->configuration['list_id'], $model->listId);
    $template = ModelFactory::create($this->configuration['template']);
    $this->assertEquals($template, $model->template);
    $this->assertSame($this->configuration['status'], $model->status);
    $this->assertSame($this->configuration['sent_at'], $model->sentAt);
    $created = new \DateTime($this->configuration['created']);
    $this->assertEquals($created, $model->created);
  }

}
