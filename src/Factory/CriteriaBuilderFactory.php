<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 05:11 م
 */

namespace App\Factory;


use App\Builder\CriteriaBuilder;

/**
 * Class CriteriaBuilderFactory
 * @package App\Factory
 */
class CriteriaBuilderFactory
{
    /**
     * @param array $queries
     * @return CriteriaBuilder
     */
    public static function create()
    {
        return new CriteriaBuilder();
    }
}