<?php
/**
 * Created by PhpStorm.
 * User: ljx
 * Date: 2019/8/30
 * Time: 10:09 AM
 */

function create($class,$attributes = [])
{
    return factory($class)->create($attributes);
}

function make($class,$attributes=[])
{
    return factory($class)->make($attributes);
}

function raw($class,$attributes = [])
{
    return factory($class)->raw($attributes);
}