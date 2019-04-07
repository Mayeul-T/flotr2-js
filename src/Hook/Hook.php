<?php
/**
 * Created by PhpStorm.
 * User: mayeu
 * Date: 07/04/2019
 * Time: 23:01
 */

namespace Flotr2\Hook;


abstract class Hook
{
    public $options;
    public abstract function draw();
}