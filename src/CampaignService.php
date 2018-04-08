<?php

namespace Klaviyo;

use Klaviyo\Model\CampaignModel;
use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\CampaignIdInterface;

/**
 * The campaign manager class used to handle campaigns.
 */
class CampaignService extends BaseService
{

    use PagerTrait;

    /**
     * Retrieve a specific campaign from Klaviyo.
     *
     * @param CampaignIdInterface $id
     *   The id for which to retrieve a campaign.
     *
     * @return CampaignModel
     *   The campaign object retrieved by the specified id.
     */
    public function getCampaign(CampaignIdInterface $id)
    {
        $response = $this->api->request('GET', $this->getResourcePath('campaign/' . $id->getId()));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
    }

    /**
     * Retrieve all campaigns from Klaviyo.
     *
     * @return array
     *     An array of CampaignModels that represent all campaigns in Klaviyo.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getAllCampaigns()
    {
        return $this->getAllRecords($this->getResourcePath('campaigns'));
    }

    /**
     * Get campaigns from a specific page.
     *
     * @param int $page
     *    The page number to retrieve.
     * @param int $count
     *    The number of items per page.
     *
     * @return array
     *    An array of records from the specified page.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getCampaignsFromPage($page = 0, $count = 0)
    {
        return $this->getRecordsFromSpecificPage($this->getResourcePath('campaigns'), $page, $count);
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
     * Update/Modify and existing campaign.
     *
     * @param CampaignModel $campaign
     *     The campaign that should be updated.
     *
     * @return CampaignModel
     *    The updated campaign model.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function updateCampaign(CampaignModel $campaign)
    {
        $response = $this->api->request(
            'PUT',
            $this->getResourcePath("campaign/{$campaign->getId()}"),
            $campaign->toArray()
        );
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
    }

    /**
     * Send a campaign immediately.
     *
     * @param CampaignIdInterface $campaign
     *   The id of the campaign to send immediately.
     *
     * @return array
     *   The response from the api.
     */
    public function sendCampaignImmediately(CampaignIdInterface $campaign)
    {
        $response = $this->api->request('POST', $this->getResourcePath("campaign/{$campaign->getId()}/send"));
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Schedule a campaign for a time in the future.
     *
     * @param CampaignIdInterface $campaign
     *   The id of the campaign to send immediately.
     * @param \DateTime $send_time
     *   A future date and time to send the campaign.
     *
     * @return array
     *   The response from the api.
     */
    public function scheduleCampaign(CampaignIdInterface $campaign, \DateTime $send_time)
    {
        // @todo: So the API is wrong about this one we should file a bug as it
        // it currently does not treat the send time as UTC, but instead it treats
        // it as the default time specified by the account.
        // $send_time->setTimezone(new \DateTimeZone('UTC'));
        $options = ['send_time' => $send_time->format('Y-m-d H:i:s')];
        $response = $this->api->request(
            'POST',
            $this->getResourcePath("campaign/{$campaign->getId()}/schedule"),
            $options
        );
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Cancel a campaign.
     *
     * @param CampaignIdInterface $campaign
     *   The id of the campaign to send immediately.
     *
     * @return CampaignModel
     *   The cancelled campaign.
     */
    public function cancelCampaign(CampaignIdInterface $campaign)
    {
        $response = $this->api->request('POST', $this->getResourcePath("campaign/{$campaign->getId()}/cancel"));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
    }
}
