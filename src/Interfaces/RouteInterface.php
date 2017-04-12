<?php
/**
 * Created by JiangJiaCai.
 * User: LongBob
 * Date: 17-4-11
 * Time: 下午10:36
 */

namespace FastD\Annotation\Interfaces;


interface RouteInterface extends TypesInterface
{

    /**
     * check the request is legal
     * @return bool
     */
    public function checkRequestMethod();

    public function checkRequestMethodIsAjax();
}