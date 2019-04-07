<?php

namespace Flotr2\Charts;

class Basic extends Graph
{
    public function __construct($container_id)
    {
        parent::__construct($container_id);
    }

    public function draw()
    {
        foreach ($this->hooks as $hook){
            $this->options = array_merge($this->options, $hook->options);
        }

        //déclaration en JS des options
        $optionsDec = 'options='.json_encode($this->options).';';
        //création de la fonction drawGraph(opts) qui permet de dessinner le graphe
        $drawGraphFct = 'function drawGraph (opts) {
            var o = Flotr._.extend(Flotr._.clone(options), opts || {});
            return Flotr.draw(container,'.json_encode($this->data).',o);
        }graph = drawGraph();';

        //Récupération de draw de chaque hook
        $drawHook = '';
        foreach ($this->hooks as $hook) {
            $drawHook .= $hook->draw();
        }

        return '(function mouse_zoom (container) {' . $optionsDec.$drawGraphFct . $drawHook . '})(document.getElementById("'.$this->container_id.'"));';
    }
}