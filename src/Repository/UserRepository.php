<?php

namespace App\Repository;


use App\Adapter\ProviderInterface;
use Doctrine\Common\Collections\Criteria;

class UserRepository
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function findBy(Criteria $criteria)
    {
        $users = $this->provider->findBy('users');

        return $users->matching($criteria);
    }
}