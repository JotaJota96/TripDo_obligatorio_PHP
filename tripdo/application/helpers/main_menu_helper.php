<?php

function mainMenu(){
    return array(
        array(
            'title'=> 'Incio',
            'url' => base_url('/')
        ),
        array(
            'title'=> 'Login',
            'url' => base_url('/login')
        ),
        array(
            'title'=> 'Registro',
            'url' => base_url('/registro')
        ),
        array(
            'title'=> 'Sobre nosotros',
            'url' => base_url('/Sobre nosotros')
        ),
        array(
            'title'=> 'Buscar',
            'url' => base_url('/buscar')
        ),
        array(
            'title'=> 'Noticias',
            'url' => base_url('/noticias')
        ),
        array(
            'title'=> 'Contacto',
            'url' => base_url('/contacto')
        ),
    );
}