<?php 

function getRegisterRules(){
    return array(
        array(
                'field' => 'nicknme',
                'label' => 'nickname',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Debes proporcionar un %s',
                        'trim' => '%s tiene espacios en blanco',
                        'min_length[5]' => '%s debe tener un mínimo de 5 caracteres',
                        'max_length[12]' => '%s supera el máximo de 12 caracteres'
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
            'errors' => array(
                    'required' => 'Debes proporcionar un %s'
            )
        ),
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'required',
            'errors' => array(
                    'required' => 'Debes proporcionar un %s'
            )
        ),
        array(
            'field' => 'apellido',
            'label' => 'Apellido',
            'rules' => 'required',
            'errors' => array(
                    'required' => 'Debes proporcionar un %s'
            )
        ),

        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required',
            'errors' => array(
                    'required' => 'Debes proporcionar un %s'
            )
        )
    );   
}