<?php 

function getRegisterRules(){
    return array(
                'field' => 'nicknme',
                'label' => 'nickname',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),
        array(
                'field' => 'contrasenia',
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Debes proporcionar una %s.',
                ),
        ),
        array(
                'field' => 'contrasenia2',
                'label' => 'Confirmar Contraseña',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),
        array(
                'field' => 'apellido',
                'label' => 'Apellido',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),

        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),
        array(
                'field' => 'telefono',
                'label' => 'Teléfono',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),

        array(
                'field' => 'biografia',
                'label' => 'Email',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        ),

        array(
                'field' => 'imagen',
                'label' => 'Foto',
                'rules' => 'required',
                'errrors' => array(
                        'required' => 'Debes proporcionar un %s'
                )
        )
        
}