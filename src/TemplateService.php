<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\RenderedTemplateModel;
use Klaviyo\Model\TemplateModel;

/**
 * The template manager class used to handle templates.
 */
class TemplateService extends BaseService
{
    use PagerTrait;


    /**
     * Retrieve all lists from Klaviyo.
     *
     * @return array        An array of TemplateModels that represent all templates in Klaviyo.
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getAllTemplates(): array
    {
        return $this->getAllRecords($this->getResourcePath('email-templates'));
    }


    /**
     * Update the specified template.
     *
     * @param TemplateModel $template
     *   The template object to update.
     *
     * @return TemplateModel
     *   The updated template object.
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function updateTemplate(TemplateModel $template): TemplateModel
    {
        $options = ['name' => $template->name, 'html' => $template->html->saveHtml()];
        $response = $this->api->request('PUT', $this->getResourcePath("email-template/{$template->id}"), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'email-template');
    }


    /**
     * Create a new template.
     *
     * @param string $name          The name of the template to be created.
     * @param \DOMDocument $html    The HTML content for this template.
     *
     * @return TemplateModel        The template object created.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function createTemplate(string $name, \DOMDocument $html): TemplateModel
    {
        $options = [
            'name' => $name,
            'html' => $html->saveHTML()
        ];
        $response = $this->api->request('POST', $this->getResourcePath('email-templates'), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'email-template');
    }


    /**
     * Delete an existing template.
     *
     * @param TemplateModel $template   The template object to be deleted.
     *
     * @return TemplateModel        The deleted template object.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function deleteTemplate(TemplateModel $template): TemplateModel
    {
        $response = $this->api->request('DELETE', $this->getResourcePath("email-template/{$template->id}"));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'email-template');
    }

    /**
     * @param TemplateModel $template The name of the new email template.
     * @param string $name                  The name of the new email template.
     *
     * @return TemplateModel                The newly created Email Template object with summary information.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function cloneTemplate(TemplateModel $template, string $name): TemplateModel
    {
        $response = $this->api->request('POST', $this->getResourcePath("email-template/{$template->id}/clone"), [
            'name' => $name
        ]);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'email-template');
    }

    /**
     * @param TemplateModel $template
     * @param array $context    JSON encoded hashThis is the context your email template will be rendered with.
     *                          Email templates are rendered with contexts in a similar manner to how Django templates
     *                          are rendered. This means that nested template variables can be referenced via dot
     *                          notation and template variables without corresponding context values are treated as
     *                          falsely and output nothing.
     *
     * @return RenderedTemplateModel
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function renderTemplate(TemplateModel $template, array $context = []): RenderedTemplateModel
    {
        $response = $this->api->request('POST', $this->getResourcePath("email-template/{$template->id}/render"), [
            'context' => json_encode($context)
        ]);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'rendered-template');
    }

    /**
     * @param TemplateModel $template
     * @param string $fromEmail The email address your email will be sent from and will be used in the reply-to header.
     * @param string $fromName The name or label associated with the email address you're sending from.
     * @param string $subject Subject of email
     * @param array $to Array with email/name pairs
     * @param array $context JSON encoded hashThis is the context your email template will be rendered with.
     *                          Email templates are rendered with contexts in a similar manner to how Django templates
     *                          are rendered. This means that nested template variables can be referenced via dot
     *                          notation and template variables without corresponding context values are treated as
     *                          falsely and output nothing.
     * @return bool
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function sendTemplate(
        TemplateModel $template,
        string $fromEmail,
        string $fromName,
        string $subject,
        array $to,
        array $context = []
    ): bool {
        $response = $this->api->request('POST', $this->getResourcePath("email-template/{$template->id}/send"), [
            'from_email' => $fromEmail,
            'from_name' => $fromName,
            'subject' => $subject,
            'to' => json_encode($to),
            'context' => json_encode($context)
        ]);

        $body = json_decode($response->getBody(), true);


        return $body && $body['data']['status'] === 'queued';
    }
}
