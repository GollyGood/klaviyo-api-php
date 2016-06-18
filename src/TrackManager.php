<?php

namespace Klaviyo;

use Klaviyo\Model\PersonModel;

/**
 * The track manager class used to handle lists.
 */
class TrackManager extends BaseManager {

  protected $resourcePrefix = '/api/';

  /**
   * Identify a person to the Klaviyo API.
   *
   * @param PersonModel $person
   *   An instance of the person model that should be written.
   *
   * @return bool
   *   Returns TRUE if the record was successfully written and FALSE otherwise.
   */
  public function identify(PersonModel $person) {
    $options = ['query' => ['properties' => $person]];
    $response = $this->api->request('GET', $this->getResourcePath('identify'), $options, TRUE);
    return (bool) $response->getBody()->getContents();
  }

}
