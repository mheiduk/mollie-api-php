<?php

namespace Mollie\Api\Resources;

class ProfileCollection extends CursorCollection
{
    /**
     * The name of the collection resource in Mollie's API.
     *
     * @var string
     */
    public static string $collectionName = "profiles";

    /**
     * Resource class name.
     *
     * @var string
     */
    public static string $resource = Profile::class;
}
