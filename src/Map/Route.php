<?php

/**
 * Created by JiangJiaCai.
 * User: LongBob
 * Date: 17-4-11
 * Time: 下午10:42
 */

namespace FastD\Annotation\Map;
use FastD\Annotation\Interfaces\Map;

/**
 * Route Annotation Map
 * Class Route
 * @package FastD\Annotation\Map
 */
abstract class Route implements Map
{
    /**
     * set request type used ajax
     * @param bool $t
     * @return void
     */
    abstract function ajax($t = false);

    /**
     * set request method POST|GET
     * @param string $type
     * @return void
     */
    abstract function method($type = 'GET');

    /**
     * set route info
     * @param mixed $p route param
     * @param $to route map
     * @return void
     */
    abstract function route($p , $to);
}