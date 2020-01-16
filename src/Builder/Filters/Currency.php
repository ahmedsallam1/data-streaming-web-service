<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 01:30 م
 */

namespace App\Builder\Filters;

use App\Builder\BuilderInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * Class Currency
 * @package App\Builder\Filters
 */
class Currency implements FilterInterface
{
    const FIELD = 'currency';

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
     * @param string $data
     */
    public function __construct(BuilderInterface $builder, string $data)
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
        $this->criteria->andWhere($this->criteria::expr()->eq(self::FIELD, $this->data));

        $this->builder->setCriteria($this->criteria);
    }
}