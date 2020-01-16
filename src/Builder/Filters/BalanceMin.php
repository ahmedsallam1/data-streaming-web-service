<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 09:57 م
 */

namespace App\Builder\Filters;

use App\Builder\BuilderInterface;
use Doctrine\Common\Collections\Criteria;

class BalanceMin implements FilterInterface
{
    const FIELD = 'balance';

    /**
     * @var string
     */
    private $data;

    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var Criteria
     */
    private $criteria;

    /**
     * Currency constructor.
     * @param BuilderInterface $builder
     * @param float $data
     */
    public function __construct(BuilderInterface $builder, float $data)
    {
        $this->builder = $builder;
        $this->criteria = $builder->getCriteria();
        $this->data = $data;
    }

    /**
     * Append criteria
     * @return void
     */
    public function append(): void
    {
        $this->criteria->andWhere($this->criteria::expr()->gte(self::FIELD, $this->data));

        $this->builder->setCriteria($this->criteria);
    }
}