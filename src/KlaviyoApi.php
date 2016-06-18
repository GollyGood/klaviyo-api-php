<?php

namespace Klaviyo;

use Klaviyo\Exception as KlaviyoException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * The main Klaviyo API class for communicating with the Klaviyo API.
 */
class KlaviyoApi {

  public static $endPoint = 'https://a.klaviyo.com';
  public static $dataMap = [
    '$list' => 'list',
    '$person' => 'person',
  ];

  protected $apiKey;
  protected $httpClient;

  /**
   * The constructor for KlaviyoApi.
   *
   * @param ClientInterface $http_client
   *   The HTTP client used for communication with the API.
   * @param string $api_key
   *   The API key to use when communicating with the API.
   *
   * @throws ApiException
   */
  public function __construct(ClientInterface $http_client, $api_key = '') {
    if (empty($api_key)) {
      throw new KlaviyoException\ApiException('You must supply a Klaviyo API key.');
    }

    $this->apiKey = $api_key;
    $this->httpClient = $http_client;
  }

  /**
   * Helper method for creating a new API object.
   *
   * @param string $api_key
   *   The API key to use when communicating with the API.
   *
   * @return KlaviyoApi
   *   An instance of the KlaviyoApi.
   */
  public static function create($api_key = '') {
    $httpClient = new Client(['base_uri' => self::$endPoint]);

    return new KlaviyoApi($httpClient, $api_key);
  }

  /**
   * Perform a request against the API.
   *
   * @param string $method
   *   The HTTP method to use for the request.
   * @param string $resource
   *   The path to the resource to access on the API.
   * @param array $options
   *   Additional options to pass on to the HTTP client.
   *
   * @return ResponseInterface
   *    The response of the request as provided by the HTTP client.
   */
  public function request($method, $resource, $options = []) {
    $response = NULL;

    try {
      $response = $this->httpClient->request($method, $resource, $this->prepareRequestOptions($method, $options));
    }
    catch(ClientException $e)  {
      switch ($e->getResponse()->getStatusCode()) {
        case '400':
          throw new KlaviyoException\BadRequestApiException($e->getMessage());
          break;
        case '401':
          throw new KlaviyoException\NotAuthorizedApiException($e->getMessage());
          break;
        case '404':
          throw new KlaviyoException\NotFoundApiException($e->getMessage());
          break;
        case '500':
          throw new KlaviyoException\ServerErrorApiException($e->getMessage());
          break;
        default:
          throw $e;
      }
    }

    return $response;
  }

  /**
   * Prepare the options array before use in the request.
   *
   * @param array $options
   *   Additional options to pass on to the HTTP client.
   *
   * @return array
   *   The prepared additional options to pass on to the HTTP client.
   */
  public function prepareRequestOptions($method, $options) {
    if ($method === 'GET' && empty($options['query']['api_key'])) {
      $options['query']['api_key'] = $this->apiKey;
    }
    elseif (empty($options['api_key'])) {
      $options['api_key'] = $this->apiKey;

      if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {
        $options = ['form_params' => $options];
      }
    }

    return $options;
  }

}
