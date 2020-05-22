<?php

function mainMenu(){
    return array(
        array(
            'title'=> 'Incio',
            'url' => base_url('/')
        ),
        array(
            'title'=> 'Iniciar Sessión',
            'url' => base_url('/login')
        ),
        array(
            'title'=> 'Registrarse',
            'url' => base_url('/registro')
        ),
        array(
            'title'=> 'Sobre nosotros',
            'url' => base_url('/sobre-nosotros')
        ),
        array(
            'title'=> 'Buscar',
            'url' => base_url('/busqueda')
        )
    );
}