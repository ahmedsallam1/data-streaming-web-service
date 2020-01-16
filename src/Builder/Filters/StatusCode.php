<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 09:48 م
 */

namespace App\Builder\Filters;

use App\Builder\BuilderInterface;
use Doctrine\Common\Collections\Criteria;

class StatusCode implements FilterInterface
{
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
        $key = 'is'.ucfirst($this->data);

        if (method_exists($this, $key)) {
            $this->{$key}();
        }

        $this->builder->setCriteria($this->criteria);
    }

    /**
     * @return void
     */
    private function isAuthorised(): void
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isAuthorised', true));
    }

    /**
     * @return void
     */
    private function isDeclined(): void
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isDeclined', true));
    }

    /**
     * @return void
     */
    private function isRefunded(): void
    {
        $this->criteria->andWhere($this->criteria::expr()->eq('isRefunded', true));
    }
}