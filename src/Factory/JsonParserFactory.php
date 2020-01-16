<?php

namespace App\Factory;

use Rodenastyle\StreamParser\Services\JsonCollectionParser;

/**
 * Class JsonParserFactory
 * @package App\Factory
 */
class JsonParserFactory
{
    /**
     * @return JsonCollectionParser
     */
    public static function create()
    {
        return new JsonCollectionParser();
    }
}