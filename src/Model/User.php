<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class User
 * @package App\Model
 */
class User
{
    /**
     * @Serializer\Groups({"Data"})
     * @var string
     */
    private $id;

    /**
     * @Serializer\Groups({"Data"})
     * @var string
     */
    private  $createdAt;

    /**
     * @Serializer\Groups({"Data"})
     * @var int
     */
    private  $status;

    /**
     * @Serializer\Groups({"Data"})
     * @var string
     */
    private $email;

    /**
     * @Serializer\Groups({"Data"})
     * @var string
     */
    private $currency;

    /**
     * @Serializer\Groups({"Data"})
     * @var float
     */
    private $balance;

    /**
     * @var bool
     */
    private $isAuthorised;

    /**
     * @var bool
     */
    private $isDeclined;

    /**
     * @var bool
     */
    private $isRefunded;

    /**
     * @param string $id
     * @return User
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $createdAt
     * @return User
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param int $status
     * @return User
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $currency
     * @return User
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param float $balance
     * @return User
     */
    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param bool $isAuthorised
     * @return User
     */
    public function setIsAuthorised(bool $isAuthorised): self
    {
        $this->isAuthorised = $isAuthorised;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAuthorised(): bool
    {
        return $this->isAuthorised;
    }

    /**
     * @param bool $isDeclined
     * @return User
     */
    public function setIsDeclined(bool $isDeclined): self
    {
        $this->isDeclined = $isDeclined;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDeclined(): bool
    {
        return $this->isDeclined;
    }

    /**
     * @param bool $isRefunded
     * @return User
     */
    public function setIsRefunded(bool $isRefunded): self
    {
        $this->isRefunded = $isRefunded;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRefunded(): bool
    {
        return $this->isRefunded;
    }
}