<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 01:23 م
 */

namespace App\Builder;

use Doctrine\Common\Collections\Criteria;

/**
 * Interface BuilderInterface
 * @package App\Builder
 */
interface BuilderInterface
{
    /**
     * @return CriteriaBuilder
     */
    public function create(): CriteriaBuilder;

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function setCriteria(Criteria $criteria);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param array $queries
     * @return mixed
     */
    public function setQueries(array $queries);
}