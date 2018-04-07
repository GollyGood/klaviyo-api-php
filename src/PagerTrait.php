<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\PageModel;

/**
 * Trait for adding a pager to a class.
 */
trait PagerTrait
{

    /**
     * Retrieve the KlaviyoApi service object.
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Retrieve all records for the specified paginated resource.
     *
     * @param string $resource
     *     The resource path to retrieve and paginate against.
     * @param array $queryParameters
     *
     * @return array
     *     An array of all records retrieved from the API.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getAllRecords($resource, $queryParameters = [])
    {
        $count = $this->getApi()->getOption('records_per_page');
        $page = $this->getPage($resource, 0, $count, $queryParameters);
        $records = array_map(ModelFactory::class . '::create', $page->data);
        while (count($records) < $page->total) {
            $page = $this->getPage($resource, $page->page+1, $count, $queryParameters);
            $records = array_merge($records, array_map(ModelFactory::class . '::create', $page->data));
        }

        return $records;
    }

    /**
     * Retrieve the records from a specific page.
     *
     * @param string $resource
     *     The resource path to retrieve and paginate against.
     * @param int $page
     * @param int $count
     * @param array $query_parameters
     *
     * @return PageModel[]
     *     An array of all records retrieved from the API for the specified page.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getRecordsFromSpecificPage(
        $resource,
        $page = 0,
        $count = 0,
        $query_parameters = []
    ) {
        $page = $this->getPage($resource, $page, $count, $query_parameters);
        return array_map(ModelFactory::class . '::create', $page->data);
    }

    /**
     * Retrieve a specific page from Klaviyo.
     *
     * @param string $resource
     *      The resource path to retrieve and paginate against.
     * @param int $page
     *     The page number to retrieve.
     * @param int $count
     *     The number of items per page.
     * @param array $queryParameters
     *
     * @return PageModel
     *     An array of information that represents a page. An array of
     *     information that represents a page.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\MissingModelTypeException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getPage(
        $resource,
        $page = 0,
        $count = 5,
        $queryParameters = []
    ) {
        $options = ['query' => ['page' => $page, 'count' => $count] + $queryParameters];
        $response = $this->getApi()->request('GET', $resource, $options);
        return ModelFactory::create(json_decode($response->getBody()->getContents(), true), 'page');
    }
}
