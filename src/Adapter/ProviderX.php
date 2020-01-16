<?php

namespace App\Adapter;


use App\Constant\ProviderXUserStatusConstant;
use App\Model\User;
use App\Service\JsonParser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProviderX
 * @package App\Adapter
 */
class ProviderX implements ProviderInterface
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
            ->setId($user['parentIdentification'])
            ->setCreatedAt($user['registerationDate'])
            ->setStatus($user['statusCode'])
            ->setEmail($user['parentEmail'])
            ->setCurrency($user['Currency'])
            ->setBalance($user['parentAmount'])
            ->setIsAuthorised(ProviderXUserStatusConstant::AUTHORISED == $user['statusCode'])
            ->setIsDeclined(ProviderXUserStatusConstant::DECLINE == $user['statusCode'])
            ->setIsRefunded(ProviderXUserStatusConstant::REFUNDED == $user['statusCode'])
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