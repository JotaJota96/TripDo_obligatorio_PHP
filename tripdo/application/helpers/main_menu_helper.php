<?php

/**
 * Devuelve las opciones del menu que se deben mostrar dependiendo de si hay un usuario logueado o no.
 * @param string $nickname Nickname del usuario logueado o NULL si es visitante
 * @return array
 */
function mainMenu(){
    // Para saber si hay un usuario logueado necesito acceder a una variable de sesion.
    // Como desde un helpper no se puede, hago estas dos lineas que saque de StackOverflow: https://stackoverflow.com/questions/15182862/passing-a-session-variable-in-a-function-to-a-helper-in-codeigniter
    $CI = & get_instance();  // esto obtiene la instancia del objeto (algun controller) que llama al helper
    $nickname = $CI->session->userdata('nickname'); // le pido a ese controller que busque en la sesion la variable que necesito

    // array base que incluye las opciones a mostrar siempre
    $menu = array(
        array(
            'title'=> 'Incio',
            'url' => base_url('/')
        ),
        array(
            'title'=> 'Buscar',
            'url' => base_url('/busqueda')
        ),
        /*array(
            'title'=> 'Sobre nosotros',
            'url' => base_url('/sobre-nosotros')
        ),*/
    );

    // se agregan mas opciones al menu dependiendo de si hay un usuario logueado o no
    if ($nickname == null){
        // si NO hay usuario logueado, agrego opciones de login, registro, etc
        array_push($menu, 
            array(
                'title'=> 'Iniciar sesión',
                'url' => base_url('/login')
            ),
            array(
                'title'=> 'Registrarse',
                'url' => base_url('/registro')
            )
        );
    }else{
        // si SI hay un usuario logueado, agrego opciones de crear viaje, logout, etc
        array_push($menu, 
            array(
                'title'=> 'Mis viajes',
                'url' => base_url('/misViajes')
            ),
            array(
                'title'=> 'Crear Viaje',
                'url' => base_url('/crearViaje')
            ),
            array(
                'title'=> 'Cerrar sesión',
                'url' => base_url('/login/salir')
            ),
            array(
                'title'=> $nickname,
                'url' => base_url()
            )
        );
    }
    return $menu;
}