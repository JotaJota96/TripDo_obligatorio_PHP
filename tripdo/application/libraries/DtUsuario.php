<?php
class DtUsuario {
  public $nickname;
  public $email;
  public $contrasenia;
  public $nombre;
  public $apellido;
  public $telefono;
  public $biografia;
  public $imagen;
  public $verificado;

  function __construct(){}
  
  function get_array(){
      $ret = array(
        'nickname' => $this->nickname,
        'email' => $this->email,
        'contrasenia' => $this->contrasenia,
        'nombre' => $this->nombre,
        'apellido' => $this->apellido,
        'telefono' => $this->telefono,
        'biografia' => $this->biografia,
        'imagen' => $this->imagen,
        'verificado' => $this->verificado
      );
      return $ret;
  }
}
?>