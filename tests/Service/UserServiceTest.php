<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 10:58 م
 */

namespace App\Tests\Service;


use App\Constant\ProviderYUserStatusConstant;
use App\Model\User;
use App\Service\UserService;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserServiceTest extends KernelTestCase
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(UserService::class)
        ;
    }

    /**
     * @test
     */
    public function testGetBy()
    {
        $users = $this->service->getBy([
            'provider' => 'DataProviderY',
            'statusCode' => 'authorised',
            'balanceMin' => 500
        ]);

        $this->assertTrue(!empty($users));
        $this->assertInstanceOf(User::class, current($users));
    }

    /**
     * @test
     */
    public function testFromDataProviderX()
    {
        $criteria = new Criteria();
        $criteria->where($criteria::expr()->eq('currency', 'USD'));

        $users = $this->service->fromDataProviderX($criteria);

        $this->assertTrue(!empty($users));
        $this->assertInstanceOf(User::class, current($users));
        $this->assertEquals('USD', current($users)->getCurrency());
    }

    /**
     * @test
     */
    public function testFromDataProviderY()
    {
        $criteria = new Criteria();
        $criteria->where($criteria::expr()->eq('isDeclined', true));

        $users = $this->service->fromDataProviderY($criteria);

        $this->assertTrue(!empty($users));
        $this->assertInstanceOf(User::class, current($users));
        $this->assertEquals(ProviderYUserStatusConstant::DECLINE, current($users)->getStatus());
    }
}