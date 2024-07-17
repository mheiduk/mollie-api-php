<?php

namespace Mollie\Api\Resources;

class PaymentCollection extends CursorCollection
{
    /**
     * The name of the collection resource in Mollie's API.
     *
     * @var string
     */
    public static string $collectionName = "payments";

    /**
     * Resource class name.
     *
     * @var string
     */
    public static string $resource = Payment::class;
}
