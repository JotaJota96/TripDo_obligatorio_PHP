<?php
class DtViajero {
  public $idUsuario;
  public $idViaje;
  public $valoracion;
  public $texto;

  function __construct(){}

  function get_array(){
    $dato = array(
        'idUsuario' => $this->idUsuario,
        'idViaje' => $this->idViaje,
        'valoracion'=>$this->valoracion,
        'texto'=>$this->texto
    );
    return $dato;
  }
}
?>