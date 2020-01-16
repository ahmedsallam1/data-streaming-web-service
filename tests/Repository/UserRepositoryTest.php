<?php

namespace App\Tests\Repository;


use App\Adapter\ProviderInterface;
use App\Adapter\ProviderX;
use App\Factory\JsonParserFactory;
use App\Model\User;
use App\Repository\UserRepository;
use App\Service\JsonParser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var Criteria
     */
    private $criteria;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        static::bootKernel();
        $providerX = static::$kernel->getContainer()->get(ProviderX::class);

        $this->repository = new UserRepository($providerX);

        $this->criteria = new Criteria();
    }

    /**
     * @test
     */
    public function testGetAll()
    {
        $users = $this->repository->findBy(new Criteria());

        $this->assertInstanceOf(ArrayCollection::class, $users);
        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
    }

    /**
     * @test
     */
    public function testGetAuthorised()
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isAuthorised', true));

        $users = $this->repository->findBy($this->criteria);

        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertTrue($users->first()->isAuthorised());
    }

    /**
     * @test
     */
    public function testGetDeclined()
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isDeclined', true));

        $users = $this->repository->findBy($this->criteria);

        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertTrue($users->first()->isDeclined());
    }

    /**
     * @test
     */
    public function testGetRefunded()
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isRefunded', true));

        $users = $this->repository->findBy($this->criteria);
        $this->assertTrue($users->isEmpty());
    }

    /**
     * @test
     */
    public function testBalanceMin()
    {
        $this->criteria->andWhere($this->criteria::expr()->gte('balance', 200));

        $users = $this->repository->findBy($this->criteria);

        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertGreaterThanOrEqual(200, $users->first()->getBalance());
    }

    /**
     * @test
     */
    public function testBalanceMax()
    {
        $this->criteria->andWhere($this->criteria::expr()->lte('balance', 500));

        $users = $this->repository->findBy($this->criteria);

        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertLessThanOrEqual(500, $users->first()->getBalance());
    }

    /**
     * @test
     */
    public function testCurrency()
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('currency', 'EUR'));

        $users = $this->repository->findBy($this->criteria);

        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertEquals('EUR', $users->first()->getCurrency());
    }

    /**
     * @return array
     */
    private function getData()
    {
        return array (
            'users' =>
                array (
                    0 =>
                        array (
                            'parentAmount' => 280,
                            'Currency' => 'EUR',
                            'parentEmail' => 'parent1@parent.eu',
                            'statusCode' => 1,
                            'registerationDate' => '2018-11-30',
                            'parentIdentification' => 'd3d29d70-1d25-11e3-8591-034165a3a613',
                        ),
                    1 =>
                        array (
                            'parentAmount' => 200.5,
                            'Currency' => 'USD',
                            'parentEmail' => 'parent2@parent.eu',
                            'statusCode' => 2,
                            'registerationDate' => '2018-01-01',
                            'parentIdentification' => 'e3rffr-1d25-dddw-8591-034165a3a613',
                        ),
                    2 =>
                        array (
                            'parentAmount' => 500,
                            'Currency' => 'EGP',
                            'parentEmail' => 'parent3@parent.eu',
                            'statusCode' => 1,
                            'registerationDate' => '2018-02-27',
                            'parentIdentification' => '4erert4e-2www-wddc-8591-034165a3a613',
                        ),
                    3 =>
                        array (
                            'parentAmount' => 400,
                            'Currency' => 'AED',
                            'parentEmail' => 'parent4@parent.eu',
                            'statusCode' => 1,
                            'registerationDate' => '2019-09-07',
                            'parentIdentification' => 'd3dwwd70-1d25-11e3-8591-034165a3a613',
                        ),
                    4 =>
                        array (
                            'parentAmount' => 200,
                            'Currency' => 'EUR',
                            'parentEmail' => 'parent5@parent.eu',
                            'statusCode' => 1,
                            'registerationDate' => '2018-10-30',
                            'parentIdentification' => 'd3d29d40-1d25-11e3-8591-034165a3a6133',
                        ),
                ),
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}