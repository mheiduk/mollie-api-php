<?php

namespace Mollie\Api\Resources;

use Mollie\Api\Contracts\ResponseContract;
use Mollie\Api\MollieApiClient;

#[\AllowDynamicProperties]
class ResourceFactory
{
    /**
     * Create resource object from Api result
     *
     * @param ResponseContract $response
     * @param BaseResource $resource
     * @return BaseResource
     */
    public static function createFromApiResult(ResponseContract $response, BaseResource $resource): BaseResource
    {
        foreach ($response->json() as $property => $value) {
            $resource->{$property} = $value;
        }

        return $resource;
    }

    /**
     * @param MollieApiClient $client
     * @param string $resourceClass
     * @param array $data
     * @param null $_links
     * @param string $resourceCollectionClass
     * @return BaseCollection
     */
    public static function createBaseResourceCollection(
        MollieApiClient $client,
        string $resourceClass,
        ?array $data = null,
        ?object $_links = null,
        ?string $resourceCollectionClass = null
    ): BaseCollection {
        $resourceCollectionClass = $resourceCollectionClass ?: $resourceClass . 'Collection';
        $data = $data ?: [];

        /** @var BaseCollection $result */
        $result = new $resourceCollectionClass(count($data), $_links);
        foreach ($data as $item) {
            $result[] = static::createFromApiResult($item, new $resourceClass($client));
        }

        return $result;
    }

    /**
     * @param MollieApiClient $client
     * @param array $input
     * @param string $resourceClass
     * @param null $_links
     * @param null $resourceCollectionClass
     * @return CursorCollection
     */
    public static function createCursorResourceCollection(
        MollieApiClient $client,
        array $input,
        string $resourceClass,
        ?object $_links = null,
        ?string $resourceCollectionClass = null
    ): CursorCollection {
        if (null === $resourceCollectionClass) {
            $resourceCollectionClass = $resourceClass . 'Collection';
        }

        /** @var CursorCollection $data */
        $data = new $resourceCollectionClass($client, count($input), $_links);
        foreach ($input as $item) {
            $data[] = static::createFromApiResult($item, new $resourceClass($client));
        }

        return $data;
    }
}
