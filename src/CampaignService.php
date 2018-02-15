<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;

/**
 * The campaign manager class used to handle campaigns.
 */
class CampaignService extends BaseService
{
    /**
     * Retrieve a specific campaign from Klaviyo.
     *
     * @param string $id
     *   The id for which to retrieve a campaign.
     *
     * @return CampaignModel
     *   The campaign object retrieved by the specified id.
     */
    public function getCampaign($id)
    {
        $response = $this->api->request('GET', $this->getResourcePath("campaign/$id"));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
    }

    /**
     * Create a new campaign.
     *
     * @param array $configuration
     *   An array of configuration parameters for the new campaign.
     *
     *   Allowed elements:
     *   * list_id: string
     *     The ID of the List object you will send this campaign to.
     *   * template_id: string
     *     The ID of the Email Template object that will be the content of this
     *     campaign. Note the Email Template is copied when creating this
     *     campaign, so future changes to that Email Template will not alter the
     *     content of this campaign.
     *   * from_email: string
     *     The email address your email will be sent from and will be used in the
     *     reply-to header.from_namestringThe name or label associated with the
     *     email address you're sending from.
     *   * subject: string
     *   * name (optional): string
     *     A name for this campaign. If not specified, this will default to the
     *     subject of the campaign.
     *   * use_smart_sending (optional): boolean
     *     If set, limits the number of emails sent to an individual within a
     *     short period. If not specified, defaults to True.
     *   * add_google_analytics (optional): boolean
     *     If specified, adds Google Analytics tracking tags to links. If not
     *     specified, defaults to False.
     *
     * @return CampaignModel
     *   The newly created campaign object.
     */
    public function createCampaign($configuration)
    {
        $response = $this->api->request('POST', $this->getResourcePath('campaigns'), $configuration);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
    }

    /**
     * Send a campaign immediately.
     *
     * @param string $id
     *   The id of the campaign to send immediately.
     *
     * @return array
     *   The response from the api.
     */
    public function sendCampaignImmediately($id)
    {
        $response = $this->api->request('POST', $this->getResourcePath("campaign/$id/send"));
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Schedule a campaign for a time in the future.
     *
     * @param string $id
     *   The id of the campaign to send immediately.
     * @param \DateTime $send_time
     *   A future date and time to send the campaign.
     *
     * @return array
     *   The response from the api.
     */
    public function scheduleCampaign($id, \DateTime $send_time)
    {
        // @todo: So the API is wrong about this one we should file a bug as it
        // it currently does not treat the send time as UTC, but instead it treats
        // it as the default time specified by the account.
        // $send_time->setTimezone(new \DateTimeZone('UTC'));
        $options = ['send_time' => $send_time->format('Y-m-d H:i:s')];
        $response = $this->api->request('POST', $this->getResourcePath("campaign/$id/schedule"), $options);
        return json_decode($response->getBody()->getContents(), true);
    }
}
