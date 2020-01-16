<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 01:31 م
 */

namespace App\Builder;


use Doctrine\Common\Collections\Criteria;

/**
 * Class CriteriaBuilder
 * @package App\Builder
 */
class CriteriaBuilder implements BuilderInterface
{
    const FILTERS_NAMESPACE = "App\\Builder\\Filters\\";

    /**
     * @var array
     */
    private $queries;

    /**
     * @var Criteria
     */
    private $criteria;

    /**
     * @return CriteriaBuilder
     */
    public function create() : self
    {
        $this->init();

        foreach ($this->queries as $key => $value) {
            $filterClass = self::FILTERS_NAMESPACE.ucfirst($key);

            if (!class_exists($filterClass)) {
                continue;
            }

            (new $filterClass($this, $value))->append();
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function init(): self
    {
        $this->setCriteria(new Criteria());

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return CriteriaBuilder
     */
    public function setCriteria(Criteria $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return Criteria
     */
    public function getCriteria(): Criteria
    {
        return $this->criteria;
    }

    /**
     * @param array $queries
     * @return CriteriaBuilder
     */
    public function setQueries(array $queries): self
    {
        $this->queries = $queries;

        return $this;
    }
}