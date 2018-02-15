<?php

namespace Klaviyo;

use Interop\Http\Factory\RequestFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Klaviyo\Exception\ApiConnectionException;
use Klaviyo\Exception\ApiException;
use Klaviyo\Exception\BadRequestApiException;
use Klaviyo\Exception\NotAuthorizedApiException;
use Klaviyo\Exception\NotFoundApiException;
use Klaviyo\Exception\ServerErrorApiException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * The main Klaviyo API class for communicating with the Klaviyo API.
 */
class KlaviyoApi
{
    public static $endPoint = 'https://a.klaviyo.com';
    public static $dataMap = [
        '$list' => 'list',
        '$person' => 'person',
    ];

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * The constructor for KlaviyoApi.
     *
     * @param HttpClientInterface $httpClient       The HTTP client used for communication with the API.
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param string $apiKey                        The API key to use when communicating with the API.
     *
     * @param array $options
     */
    public function __construct(
        HttpClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $apiKey,
        array $options = []
    ) {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;

        $this->options = $options + [
            'records_per_page' => 50,
        ];
    }

    /**
     * Retrieve the model type based on the perceived model type.
     *
     * Sometimes Klaviyo changes the model type by placing "$" in front of them
     * also I am not sure if there are other mutations that might happen on this
     * or if they might change. In order to attempt to prevent this we will use a
     * getter for the Klaviyo model type.
     *
     * @param string $modelType
     *   The perceived model type.
     * @param bool $reverse
     *   Should we try looking of the model type in the reverse direction?
     *   e.x. The way Klaviyo might hand us a transformed model type.
     *
     * @return string
     *   The model type or the perceived model type depending on the specified
     *   direction.
     */
    public static function getModelType(string $modelType, bool $reverse = false): string
    {
        $data_map = static::$dataMap;

        if ($reverse) {
            $data_map = array_flip($data_map);
        }

        if (isset($data_map[$modelType])) {
            $modelType = $data_map[$modelType];
        }

        return $modelType;
    }

    /**
     * Retrieve a specific option.
     *
     * @param string $option
     *   The option name to retrieve.
     *
     * @return mixed
     *   The value of the option requested.
     */
    public function getOption(string $option)
    {
        $value = null;

        if (!empty($this->options[$option])) {
            $value = $this->options[$option];
        }

        return $value;
    }

    /**
     * Set a specific option.
     *
     * @param string $option
     *   The option name to set.
     * @param mixed $value
     *   The value of the option to set.
     *
     * @return $this
     */
    public function setOption(string $option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * Retrieve an an array of all available options.
     */
    public function getAllOptions(): array
    {
        return $this->options;
    }

    /**
     * Perform a request against the API.
     *
     * @param string $method        The HTTP method to use for the request.
     * @param string $resource      The path to the resource to access on the API.
     * @param array $options        Additional options to pass on to the HTTP client.
     * @param bool $public
     *
     * @return ResponseInterface        The response of the request as provided by the HTTP client.
     *
     * @throws BadRequestApiException
     * @throws NotAuthorizedApiException
     * @throws NotFoundApiException
     * @throws ServerErrorApiException
     * @throws ApiConnectionException
     */
    public function request(string $method, string $resource, array $options = [], bool $public = false): ResponseInterface
    {
        $response = null;

        try {
            $request = $this->requestFactory->createRequest($method, self::$endPoint . '/' . ltrim($resource, '/'));
            $request = $this->prepareRequest($request, $options, $public);

            $response = $this->httpClient->fetch($request);
        } catch (\Exception $e) {
            if (method_exists($e, 'getResponse')) {
                switch ($e->getResponse()->getStatusCode()) {
                    case '400':
                        throw new BadRequestApiException($e->getMessage());

                    case '401':
                        throw new NotAuthorizedApiException($e->getMessage());

                    case '404':
                        throw new NotFoundApiException($e->getMessage());

                    case '500':
                        throw new ServerErrorApiException($e->getMessage());

                    default:
                        throw new ApiConnectionException($e->getMessage());
                }
            } else {
                throw new ApiConnectionException($e->getMessage());
            }
        }

        return $response;
    }

    /**
     * Prepare the options array before use in the request.
     *
     * @param RequestInterface $request
     * @param array $options
     *   Additional options to pass on to the HTTP client.
     *
     * @param bool $public
     * @return RequestInterface The prepared additional options to pass on to the HTTP client.*   The prepared additional options to pass on to the HTTP client.
     */
    public function prepareRequest(RequestInterface $request, array $options, bool $public = false): RequestInterface
    {
        if ($request->getMethod() === 'GET') {
            if (empty($options['query']['api_key'])) {
                $options['query']['api_key'] = $this->apiKey;
            }

            if ($public) {
                $api_key = $options['query']['api_key'];
                unset($options['query']['api_key']);
                $options = ['query' => ['data' => base64_encode(json_encode(['token' => $api_key] + $options['query']))]];
            }
            $uri = $request->getUri();
            $uri = $uri->withQuery(http_build_query($options['query']));
            $request = $request->withUri($uri);
        } elseif (empty($options['api_key'])) {
            $options['api_key'] = $this->apiKey;
        }

        $stream = $this->streamFactory->createStream(http_build_query($options));
        $request = $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        $request = $request->withBody($stream);

        return $request;
    }
}
