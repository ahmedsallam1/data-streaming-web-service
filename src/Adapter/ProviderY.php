<?php

namespace App\Adapter;


use App\Constant\ProviderYUserStatusConstant;
use App\Model\User;
use App\Service\JsonParser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProviderY
 * @package App\Adapter
 */
class ProviderY implements ProviderInterface
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @var
     */
    private $jsonParser;

    public function __construct(string $filePath, JsonParser $jsonParser)
    {
        $this->filePath = $filePath;
        $this->jsonParser = $jsonParser;
    }

    /**
     * @param string|null $key
     * @return ArrayCollection|mixed
     * @throws \Exception
     */
    public function findBy(string $key = null)
    {
        $items = $this->stream($key);
        $arrayCollection = new ArrayCollection();

        foreach ($items as $item) {
            if (method_exists($this, 'prepare'.$key)) {
                $arrayCollection->add($this->{'prepare'.$key}($item));
            }
        }

        return $arrayCollection;
    }

    /**
     * @param array $user
     * @return User|array
     */
    private function prepareUsers(array $user)
    {
        $model = new User();

        $model
            ->setId($user['id'])
            ->setCreatedAt($user['created_at'])
            ->setStatus($user['status'])
            ->setEmail($user['email'])
            ->setCurrency($user['currency'])
            ->setBalance($user['balance'])
            ->setIsAuthorised(ProviderYUserStatusConstant::AUTHORISED == $user['status'])
            ->setIsDeclined(ProviderYUserStatusConstant::DECLINE == $user['status'])
            ->setIsRefunded(ProviderYUserStatusConstant::REFUNDED == $user['status'])
        ;

        return $model;
    }

    /**
     * @param string $key
     * @return mixed|null
     * @throws \Exception
     */
    private function stream(string $key)
    {
        $items = $this->jsonParser->parse($this->filePath);

        return (new ArrayCollection($items))->get($key);
    }
}