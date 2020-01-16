<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 10:40 م
 */

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Class UserControllerTest
 * @package App\Tests\Controller
 */
class UserControllerTest extends WebTestCase
{
    /**
     * @var
     */
    private $client;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @test
     */
    public function testIndex()
    {
        $this->client->request('GET', '/api/users', [
            'query' => [
                'provider' => 'DataProviderY',
                'statusCode' => 'authorised',
                'balanceMin' => 200
            ]
        ]);
        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertJson($response->getContent());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}