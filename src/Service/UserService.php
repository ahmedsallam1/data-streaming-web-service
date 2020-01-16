<?php

namespace App\Service;


use App\Adapter\ProviderInterface;
use App\Builder\Director;
use App\Factory\CriteriaBuilderFactory;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;

class UserService
{
    /**
     * @var Director
     */
    private $director;

    /**
     * @var CriteriaBuilderFactory
     */
    private $criteriaBuilder;

    /**
     * @var ProviderInterface
     */
    private $providerX;

    /**
     * @var ProviderInterface
     */
    private $providerY;

    /**
     * UserService constructor.
     * @param Director $director
     * @param CriteriaBuilderFactory $criteriaBuilder
     * @param ProviderInterface $providerX
     * @param ProviderInterface $providerY
     */
    public function __construct(Director $director, CriteriaBuilderFactory $criteriaBuilder, ProviderInterface $providerX, ProviderInterface $providerY)
    {
        $this->director = $director;
        $this->criteriaBuilder = $criteriaBuilder->create();
        $this->providerX = $providerX;
        $this->providerY = $providerY;
    }

    /**
     * @param array $queries
     * @return array
     */
    public function getBy(array $queries)
    {
        $users = [];
        $criteria = $this->director->build($this->criteriaBuilder->setQueries($queries));

        if (!array_key_exists('provider', $queries)) {
            $queries['provider'] = ['DataProviderX', 'DataProviderY'];
        }
        foreach ((array) $queries['provider'] as $provider) {
            $users = array_merge($users, $this->{'from'.$provider}($criteria));
        }

        return $users;
    }

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function fromDataProviderX(Criteria $criteria)
    {
        return (new UserRepository($this->providerX))->findBy($criteria)->toArray();
    }

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function fromDataProviderY(Criteria $criteria)
    {
        return (new UserRepository($this->providerY))->findBy($criteria)->toArray();
    }
}