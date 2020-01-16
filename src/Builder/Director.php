<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 01:22 م
 */

namespace App\Builder;

/**
 * Class Director
 * @package App\Builder
 */
class Director
{
    /**
     * @param BuilderInterface $builder
     * @return mixed
     */
    public function build(BuilderInterface $builder)
    {
        return $builder
            ->create()
            ->getCriteria();
    }
}