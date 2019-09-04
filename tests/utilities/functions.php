<?php
/**
 * Created by PhpStorm.
 * User: ljx
 * Date: 2019/8/30
 * Time: 10:09 AM
 */

function create($class,$attributes = [],$times = null)
{
    return factory($class,$times)->create($attributes);
}

function make($class,$attributes=[],$times = null)
{
    return factory($class,$times)->make($attributes);
}

function raw($class,$attributes = [],$times = null)
{
    return factory($class,$times)->raw($attributes);
}