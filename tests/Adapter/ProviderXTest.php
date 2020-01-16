<?php

namespace App\Tests\Adapter;


use App\Adapter\ProviderX;
use App\Model\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProviderXTest extends KernelTestCase
{
    /**
     * @var ProviderX
     */
    private $provider;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->provider = $kernel->getContainer()
            ->get('App\Adapter\ProviderX')
        ;
    }

    /**
     * @test
     * @throws \Exception
     */
    public function testFindBy()
    {
        $users = $this->provider->findBy('users');

        $this->assertInstanceOf(ArrayCollection::class, $users);
        $this->assertTrue(!$users->isEmpty());
        $this->assertInstanceOf(User::class, $users->first());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}