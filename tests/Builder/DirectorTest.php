<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 04:55 م
 */

namespace App\Tests\Builder;

use App\Builder\CriteriaBuilder;
use App\Builder\Director;
use App\Builder\Filters\Currency;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DirectorTest extends KernelTestCase
{

    /**
     * @var Director
     */
    private $director;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->director = $kernel->getContainer()
            ->get(Director::class)
        ;
    }

    /**
     * @test
     */
    public function testBuildCriteria()
    {
        $builder = new CriteriaBuilder();
        $builder->setQueries(['currency' => 'USD']);

        $criteria = $this->director->build($builder);

        $expr = $criteria->getWhereExpression();

        $this->assertInstanceOf(Criteria::class, $criteria);
        $this->assertEquals(Currency::FIELD, $expr->getField());
        $this->assertEquals('USD', $expr->getValue()->getValue());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}