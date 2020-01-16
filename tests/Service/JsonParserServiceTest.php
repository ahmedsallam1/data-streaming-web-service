<?php
namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\JsonParser;
use Tightenco\Collect\Support\Collection;

/**
 * Class JsonParserServiceTest
 * @package App\Tests\Service
 */
class JsonParserServiceTest extends KernelTestCase
{
    /**
     * @var JsonParser
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(JsonParser::class)
        ;
    }

    /**
     * @test
     */
    public function testParseJson()
    {
        $items = new Collection($this->service->parse('./json/DataProviderY.json'));

        $this->assertTrue($items->isNotEmpty());
        $this->assertTrue(is_array($items->toArray()));

    }

    /**
     * @test
     */
    public function testParseLargeJson()
    {
        $items = new Collection($this->service->parse('./json/large.json'));

        $this->assertTrue($items->isNotEmpty());
        $this->assertTrue(is_array($items->toArray()));

    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
