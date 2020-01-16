<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 04:46 م
 */

namespace App\Tests\Builder;


use App\Builder\CriteriaBuilder;
use App\Builder\Filters\Currency;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CriteriaBuilderTest extends WebTestCase
{
    /**
     * @test
     */
    public function testCreate()
    {
        $builder = new CriteriaBuilder();
        $builder->setQueries(['currency' => 'EUR']);

        $criteria = $builder
            ->create()
            ->getCriteria()
        ;

        $this->assertInstanceOf(Criteria::class, $criteria);

        $expr = $criteria->getWhereExpression();

        $this->assertEquals(Currency::FIELD, $expr->getField());
        $this->assertEquals('EUR', $expr->getValue()->getValue());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}