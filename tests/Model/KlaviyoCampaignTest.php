<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\ModelInterface;

class KlaviyoCampaignTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\CampaignModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => 'campaign',
            'id' => 'dqQnNW',
            'name' => 'Campaign Name',
            'subject' => 'Company Monthly Newsletter',
            'from_email' => 'george.washington@example.com',
            'from_name' => 'George Washington',
            'lists' => [
                [
                    'object' => 'list',
                    'id' => 'dqQnNW',
                    'name' => 'Fancy List',
                    'list_type' => 'list',
                    'created' => '2013-06-14 12:00:00',
                    'updated' => '2013-06-14 12:00:00',
                    'person_count' => 5,
                    'folder' => null,
                ],
            ],
            'template' => [
                'object' => 'email-template',
                'id' => 'fsSpPY',
                'html' => '<html><body><p>This is the email content</p></body></html>',
            ],
            'status' => 'draft',
            'status_id' => 2,
            'status_label' => 'Draft',
            'sent_at' => null,
            'send_time' => '',
            'created' => '2013-06-14 12:00:00',
            'updated' => '2013-06-14 12:00:00',
            'num_recipients' => 0,
            'is_segmented' => false,
            'campaign_type' => 'Regular',
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($this->configuration['object'], $model->objectType);
        $this->assertSame($this->configuration['id'], $model->id);
        $this->assertSame($this->configuration['name'], $model->name);
        $this->assertSame($this->configuration['subject'], $model->subject);
        $this->assertSame($this->configuration['from_email'], $model->fromEmail);
        $this->assertSame($this->configuration['from_name'], $model->fromName);
        $template = ModelFactory::create($this->configuration['template']);
        $this->assertEquals($template, $model->template);
        $this->assertSame($this->configuration['status'], $model->status);
        $this->assertSame($this->configuration['status_id'], $model->statusId);
        $this->assertSame($this->configuration['status_label'], $model->statusLabel);
        $this->assertSame($this->configuration['sent_at'], $model->sentAt);
        $this->assertSame($this->configuration['send_time'], $model->sendTime);
        $created = new \DateTime($this->configuration['created']);
        $this->assertEquals($created, $model->created);
        $updated = new \DateTime($this->configuration['updated']);
        $this->assertEquals($updated, $model->updated);
        $this->assertEquals($this->configuration['num_recipients'], $model->numRecipients);
        $this->assertEquals($this->configuration['is_segmented'], $model->isSegmented);
        $this->assertEquals($this->configuration['campaign_type'], $model->campaignType);

        $lists = [];
        foreach ($configuration['lists'] as $list) {
            $lists[] = ModelFactory::create($list);
        }
        $this->assertEquals($lists, $model->lists);
    }
}
