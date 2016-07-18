<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;

/**
 * The campaign manager class used to handle campaigns.
 */
class CampaignService extends BaseService {

  /**
   * Retrieve a specific campaign from Klaviyo.
   *
   * @param string $id
   *   The id for which to retrieve a campaign.
   *
   * @return CampaignModel
   *   The campaign object retrieved by the specified id.
   */
  public function getCampaign($id) {
    $response = $this->api->request('GET', $this->getResourcePath("campaign/$id"));
    return ModelFactory::createFromJson($response->getBody()->getContents(), 'campaign');
  }

}
