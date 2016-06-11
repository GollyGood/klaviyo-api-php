<?php

namespace Klaviyo;

use Klaviyo\Exception\ApiException;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class KlaviyoApi {

  public static $endPoint = 'https://a.klaviyo.com';

  protected $apiKey;
  protected $httpClient;

  /**
   * @todo: Document.
   */
  public function __construct(ClientInterface $http_client, $api_key = '') {
    if (empty($api_key)) {
      throw new ApiException('You must supply a Klaviyo API key.');
    }

    $this->apiKey = $api_key;
    $this->httpClient = $http_client;
  }

  /**
   * @todo: Document.
   */
  public static function create($api_key = '') {
    $httpClient = new Client(['base_uri' => self::$endPoint]);

    return new KlaviyoApi($httpClient, $api_key);
  }

  /**
   * @todo: Document.
   */
  public function request($method, $resource, $options = []) {
    return $this->httpClient->request($method, $resource, $this->prepareRequestOptions($options));
  }

  /**
   * @todo: Document.
   */
  public function prepareRequestOptions($options) {
    if (empty($options['query']['api_key'])) {
      $options['query']['api_key'] = $this->apiKey;
    }

    return $options;
  }

}
