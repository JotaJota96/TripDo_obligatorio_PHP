<?php

function ordenar($b, $a) {
    return strtotime($a['elem']->fechaAgregado) - strtotime($b['elem']->fechaAgregado);
}

function ordenarLog(&$log = array()){
    usort($log, "ordenar");
}
