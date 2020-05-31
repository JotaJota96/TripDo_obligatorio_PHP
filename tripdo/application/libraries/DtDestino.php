<?php
class DtDestino{
    public $id;
    public $pais;
    public $ciudad;
    public $idViaje;
    public $agregadoPor;
    public $fechaAgregado;

    function __construct(){}

    function get_array(){
        $dato = array(
            'id' => $this->id,
            'pais' => $this->pais,
            'ciudad'=>$this->ciudad,
            'idViaje'=>$this->idViaje,
            'agregadoPor'=>$this->agregadoPor,
            'fechaAgregado'=>$this->fechaAgregado
        );
        return $dato;
    }
}
?>
