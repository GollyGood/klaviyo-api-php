<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;

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
     * Reteive all records for the specified paginated resource.
     *
     * @param string $resource
     *   The resource path to retrieve and paginate against.
     *
     * @return array
     *    An array of all records retrieved from the API.
     */
    public function getAllRecords($resource, $query_parameters = [])
    {
        $count = $this->getApi()->getOption('records_per_page');
        $page = $this->getPage($resource, 0, $count, $query_parameters);

        $records = array_map(ModelFactory::class . '::create', $page->data);
        while (count($records) < $page->total) {
            $page = $this->getPage($resource, $page->netPage, $count, $query_parameters);
            $records = array_merge($records, array_map(ModelFactory::class . '::create', $page->data));
        }

        return $records;
    }

    /**
     * Retrieve the records from a specific page.
     *
     * @param string $resource
     *   The resource path to retrieve and paginate against.
     *
     * @return array
     *    An array of all records retrieved from the API for the specified page.
     */
    public function getRecordsFromSpecificPage($resource, $page = 0, $count = 0, $query_parameters = [])
    {
        $page = $this->getPage($resource, $page, $count, $query_parameters);
        return array_map(ModelFactory::class . '::create', $page->data);
    }

    /**
     * Retrieve a specific page from Klaviyo.
     *
     * @param int $page
     *   The page number to retrieve.
     * @param int $count
     *   The number of items per page.
     *
     * @return array
     *   An array of information that represents a page.
     */
    public function getPage($resource, $page = 0, $count = 50, $query_parameters = [])
    {
        $options = ['query' => ['page' => $page, 'count' => $count] + $query_parameters];
        $response = $this->getApi()->request('GET', $resource, $options);
        return ModelFactory::create(json_decode($response->getBody()->getContents(), true), 'page');
    }
}
