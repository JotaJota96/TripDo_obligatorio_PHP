<?php
class DtPlan {
  public $id;
  public $nombre;
  public $descripcion;
  public $latitud;
  public $longitud;
  public $link;
  public $idDestino;
  public $agregadoPor;
  public $fechaAgregado;
}
  function __construct(){}

  function get_array(){
      $ret = array(
        'id' => $this->id,
        'nombre' => $this->nombre,
        'descripcion' => $this->descripcion,
        'latitud' => $this->latitud,
        'longitud' => $this->longitud,
        'link' => $this->link,
        'idDestino' => $this->idDestino,
        'agregadoPor' => $this->agregadoPor,
        'fechaAgregado' => $this->fechaAgregado
      );
      return $ret;
  }
?>

