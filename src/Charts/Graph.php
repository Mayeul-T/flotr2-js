<?php

namespace Flotr2\Charts;

use Flotr2\Hook\Hook;

abstract class Graph
{
    protected $data;
    public $options;
    protected $hooks;
    protected $container_id;
    protected $id;

    public function __construct($container_id)
    {
        $this->container_id = $container_id;
        $this->id = uniqid();
        $this->options = [];
        $this->hooks = [];
    }

    public function addHook(Hook $hook){
        $this->hooks[] = $hook;
    }

    public function addCourbe(array $points, string $label = ''){
        $this->data[] = ['data' => $points, 'label' => $label];
    }

    public function setTitle($title){
        $this->options['title'] = $title;
    }

    public function formatAsTime($axe){
        if(empty($this->options['xaxis'])){
            $this->options['xaxis'] = [];
        }
        if ($axe != 'x' && $axe != 'y')
            throw new \Exception('$axe sens to formAsTime must be x or y');

        $this->options[$axe.'axis']['mode'] = 'time';
    }

    public abstract function draw();
}