<?php

namespace App\Service;

use App\Factory\JsonParserFactory;

class JsonParser
{
    /**
     * @var \Rodenastyle\StreamParser\Services\JsonCollectionParser
     */
    private $parser;

    /**
     * @var array
     */
    private $items = [];

    public function __construct(JsonParserFactory $parser)
    {
        $this->parser = $parser::create();
    }

    /**
     * @param string $filePath
     * @return array
     * @throws \Exception
     */
    public function parse(string $filePath)
    {
        $this->parser->parse($filePath, function (array  $items) {
            $this->items = $items;
        });

        return $this->items;
    }
}