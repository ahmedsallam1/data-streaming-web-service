<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 03:20 م
 */

namespace App\Builder\Filters;

/**
 * Interface FilterInterface
 * @package App\Builder\Filters
 */
interface FilterInterface
{
    /**
     * @return void
     */
    public function append();
}