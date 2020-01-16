<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 04:20 م
 */

namespace App\Tests\Builder\Filters;

use App\Builder\CriteriaBuilder;
use App\Builder\Filters\Currency;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CurrencyTest extends WebTestCase
{

    /**
     * @test
     */
    public function testAppend()
    {
        $builder = $this->createMock(CriteriaBuilder::class);
        $builder
            ->method('getCriteria')
            ->willReturn(new Criteria())
        ;

        $currency = new Currency($builder, 'USD');
        $currency->append();

        $expr = $builder->getCriteria()->getWhereExpression();

        $this->assertInstanceOf(Criteria::class, $builder->getCriteria());
        $this->assertEquals($currency::FIELD, $expr->getField());
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