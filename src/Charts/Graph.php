<?php

namespace Flotr2\Charts;

use Hook\Hook;

abstract class Graph
{
    protected $data;
    public $options;
    protected $hooks;
    protected $container_id;

    public function __construct($container_id)
    {
        $this->container_id = $container_id;
    }

    public function addHook(Hook $hook){
        $this->hooks[] = $hook;
    }

    public function setTitle($title){
        $this->options['title'] = $title;
    }

    public abstract function draw();
}