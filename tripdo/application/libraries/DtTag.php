<?php
class DtTag {
  public $id;
  public $texto;
  public $idDestino;
  
  function __construct(){}

  function get_array(){
    $dato = array(
        'id' => $this->id,
        'texto' => $this->texto,
        'idDestino'=>$this->idDestino
    );
    return $dato;
  }
}
?>