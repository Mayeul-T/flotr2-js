<?php
/**
 * Created by PhpStorm.
 * User: mayeu
 * Date: 07/04/2019
 * Time: 22:58
 */

namespace Flotr2\Hook;


class Zoom extends Hook
{
    public $time = 'no';
    public function __construct()
    {
        $this->options = [
            'selection' => [
                'mode' => 'x',
                'fps' => 30
            ]
        ];
    }

    public function draw(){
        //Création du graphe

        $graph = 'graph=drawGraph({
            xaxis: {min:area.x1, max:area.x2';
        $graph .= ($this->time == 'x')?', mode:\'time\'':'';
        $graph .= '}, yaxis: {min:area.y1, max:area.y2';
        $graph .= ($this->time == 'y')?', mode:\'time\'':'';
        $graph .= '}});';

        //Placement des instructions dans le hook de flotr
        $hook_select = 'Flotr.EventAdapter.observe(container, \'flotr:select\', function (area) {'.$graph.'});';

        //Hook remise à zero du zoom
        $hook_click = 'Flotr.EventAdapter.observe(container, \'flotr:click\', function () { drawGraph(); });';

        return $hook_select.$hook_click;
    }
}