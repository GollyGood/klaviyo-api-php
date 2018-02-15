<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\RenderedTemplateModel;
use Klaviyo\Model\TemplateModel;
use Klaviyo\TemplateService;
use Psr\Http\Message\RequestInterface;

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
    protected $responseTemplateZero;
    protected $responseTemplateCloned;
    protected $responseTemplateSent;
    protected $sendMailData;
    protected $renderedContext = [
        'email' => 'test@phpunit'
    ];
    protected $responseTemplateRendered;
    protected $responsePageZero;
    protected $responsePageOne;

    public function setUp()
    {
        $this->responseTemplateZero = [
            'object' => 'email-template',
            'id' => 'arY8wg',
            'name' => 'Template 1',
            'html' => '<html><body><p>This is an email for {{ email }}.</p></body></html>',
            'created' => '2016-01-01 18:58:54',
            'updated' => '2016-01-02 06:00:00',
        ];

        $this->responseTemplateCloned = [
            'object' => 'email-template',
            'id' => 'arD8og',
            'name' => 'Cloned template',
            'html' => '<html><body><p>This is an email for {{ email }}.</p></body></html>',
            'created' => '2018-01-01 18:58:54',
            'updated' => '2018-01-02 06:00:00',
        ];

        $this->responseTemplateSent = [
            'object' => 'email-template',
            'id' => $this->responseTemplateZero['id'],
            'name' => $this->responseTemplateZero['name'],
            'data' => [
                'status' => 'queued'
            ]
        ];

        $this->responseTemplateRendered = [
            "object" => "email-template",
            "id" => "dqQnNW",
            "name" => "Weekly Summary",
            "data" => [
                'html' => '<html><body><p>This is an email for '.$this->renderedContext['email'].'.</p></body></html>',
                'text' => 'This is an email for '.$this->renderedContext['email'].'.'
            ]
        ];

        $this->sendMailData = [
            'from_name' => 'Test sender',
            'from_email' => 'test@example.com',
            'subject' => "Test subject",
            'to' => [
                ['email' => 'recipient@example.com', 'name' => "Recipient"]
            ],
            'context' => [
                'name' => 'Recipient Name'
            ]
        ];

        $this->responsePageZero = [
            'object' => '$list',
            'start' => 0,
            'end' => 1,
            'page_size' => 2,
            'total' => 4,
            'page' => 0,
            'data' => [
                $this->responseTemplateZero,
                $this->responseTemplateCloned,
            ],
        ];
        $this->responsePageOne = $this->responsePageZero;
        $this->responsePageOne['start'] = 2;
        $this->responsePageOne['end'] = 3;
        $this->responsePageOne['page'] = 1;
    }

    public function getMultiPageListService()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responsePageZero));
        $responses[] = new Response(200, [], json_encode($this->responsePageOne));

        return $this->getTemplateSerive($container, $responses);
    }

    public function getTemplateSerive(&$container, $responses): TemplateService
    {
        $api = $this->getApi($this->apiKey, [], $container,  $responses);
        return new TemplateService($api);
    }

    public function testUpdateTemplate()
    {
        $container = $responses = [];
        $template = $this->templateConfiguration;
        $template['html'] = '<html><body>Yay it was changed.</body></html>';
        $responses[] = new Response(200, [], json_encode($template));

        $template_service = $this->getTemplateSerive($container, $responses);

        $template = TemplateModel::create($this->templateConfiguration);
        $template->html = '<html><body>Yay it was changed.</body></html>';

        $response = $template_service->updateTemplate($template);
        $this->assertEquals($template, $response);
    }

    public function testCreateTemplate()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseTemplateZero));
        $templateService = $this->getTemplateSerive($container, $responses);


        $html = new \DOMDocument();
        @$html->loadHTML($this->responseTemplateZero['html'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $newTemplate = $templateService->createTemplate($this->responseTemplateZero['name'], $html);

        $templateZero = new TemplateModel($this->responseTemplateZero);
        $this->assertEquals($templateZero, $newTemplate);

        /** @var RequestInterface $request */
        $request = $container[0]['request'];

        $this->assertSame('POST', $request->getMethod());

        $fields = array();
        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame(
            $this->responseTemplateZero['name'],
            $fields['name']
        );
        $this->assertSame(
            $this->responseTemplateZero['html'],
            trim($fields['html'])
        );
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testListTemplates()
    {
        $templateService = $this->getMultiPageListService();
        $templates = $templateService->getAllTemplates();

        $this->assertCount(4, $templates);

        $templateZero = new TemplateModel($this->responsePageZero['data'][0]);
        $this->assertEquals($templateZero, $templates[0]);
        $templateOne = new TemplateModel($this->responsePageZero['data'][1]);
        $this->assertEquals($templateOne, $templates[1]);
        $templateTwo = new TemplateModel($this->responsePageOne['data'][0]);
        $this->assertEquals($templateTwo, $templates[2]);
        $templateThree = new TemplateModel($this->responsePageOne['data'][1]);
        $this->assertEquals($templateThree, $templates[3]);
    }

    public function testCloneTemplate()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseTemplateCloned));
        $templateService = $this->getTemplateSerive($container, $responses);

        $templateZero = new TemplateModel($this->responseTemplateZero);

        $newTemplate = $templateService->cloneTemplate($templateZero, $this->responseTemplateCloned['name']);

        $templateCloned = new TemplateModel($this->responseTemplateCloned);
        $this->assertEquals($templateCloned, $newTemplate);

        /** @var RequestInterface $request */
        $request = $container[0]['request'];

        $this->assertSame('POST', $request->getMethod());

        $fields = array();
        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame(
            $this->responseTemplateCloned['name'],
            $fields['name']
        );
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testDeleteTemplate()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseTemplateZero));
        $templateSerive = $this->getTemplateSerive($container, $responses);

        $template = new TemplateModel($this->responseTemplateZero);
        $template = $templateSerive->deleteTemplate($template);

        $templateZero = new TemplateModel($this->responseTemplateZero);
        $this->assertEquals($templateZero, $template);

        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $this->assertSame('DELETE', $request->getMethod());

        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testRenderTemplate()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseTemplateRendered));
        $templateService = $this->getTemplateSerive($container, $responses);

        $templateZero = new TemplateModel($this->responseTemplateZero);

        $renderedModel = $templateService->renderTemplate($templateZero, $this->renderedContext);

        $renderedTemplate = new RenderedTemplateModel($this->responseTemplateRendered);
        $this->assertEquals($renderedTemplate, $renderedModel);

        /** @var RequestInterface $request */
        $request = $container[0]['request'];

        $this->assertSame('POST', $request->getMethod());

        $fields = array();
        parse_str(urldecode((string) $request->getBody()), $fields);

        $this->assertSame(
            json_encode($this->renderedContext),
            $fields['context']
        );
        $this->assertSame($this->apiKey, $fields['api_key']);
    }

    public function testSendTemplate()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responseTemplateSent));
        $templateService = $this->getTemplateSerive($container, $responses);

        $templateZero = new TemplateModel($this->responseTemplateZero);

        $rs = $templateService->sendTemplate(
            $templateZero,
            $this->sendMailData['from_email'],
            $this->sendMailData['from_name'],
            $this->sendMailData['subject'],
            $this->sendMailData['to'],
            $this->sendMailData['context']
        );

        $this->assertTrue($rs);

        /** @var RequestInterface $request */
        $request = $container[0]['request'];

        $this->assertSame('POST', $request->getMethod());

        $fields = array();
        parse_str(urldecode((string) $request->getBody()), $fields);
        $this->assertSame(
            $this->sendMailData['from_email'],
            $fields['from_email']
        );
        $this->assertSame(
            $this->sendMailData['from_name'],
            $fields['from_name']
        );
        $this->assertSame(
            $this->sendMailData['subject'],
            $fields['subject']
        );
        $this->assertSame(
            json_encode($this->sendMailData['to']),
            $fields['to']
        );
        $this->assertSame(
            json_encode($this->sendMailData['context']),
            $fields['context']
        );
        $this->assertSame($this->apiKey, $fields['api_key']);
    }
}
