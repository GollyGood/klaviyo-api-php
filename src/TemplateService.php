<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\TemplateModel;

/**
 * The template manager class used to handle templates.
 */
class TemplateService extends BaseService
{
    /**
     * Update the specified template.
     *
     * @param TemplateModel $template
     *   The template object to update.
     *
     * @return TemplateModel
     *   The updated template object.
     */
    public function updateTemplate(TemplateModel $template)
    {
        $options = ['name' => $template->name, 'html' => $template->html->saveHtml()];
        $response = $this->api->request('PUT', $this->getResourcePath("email-template/{$template->id}"), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'email-template');
    }
}
