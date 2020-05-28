<?php

function footerTags(){
    $CI = & get_instance();
    $CI->load->model('MTripDo');

    $ret = $CI->MTripDo->obtenerTopTags(10);

    return $ret;
}