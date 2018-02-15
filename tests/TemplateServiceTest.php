<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\TemplateModel;
use Klaviyo\TemplateService;

class TemplateServiceTest extends KlaviyoTestCase
{
    protected $templateConfiguration = [
        'object' => 'email-template',
        'id' => 'dqQnNW',
        'name' => 'My New Template',
        'html' => '<html><body><p>This is an email for {{ email }}.</p></body></html>',
        'created' => '2013-06-17 14:00:00',
        'updated' => '2013-06-17 14:00:00',
    ];

    public function testUpdateTemplate()
    {
        $container = $responses = [];
        $template = $this->templateConfiguration;
        $template['html'] = '<html><body>Yay it was changed.</body></html>';
        $responses[] = new Response(200, [], json_encode($template));

        $api = $this->getApi($this->apiKey, [], $container,  $responses);
        $template_service = new TemplateService($api);

        $template = TemplateModel::create($this->templateConfiguration);
        $template->html = '<html><body>Yay it was changed.</body></html>';

        $response = $template_service->updateTemplate($template);
        $this->assertEquals($template, $response);
    }
}
