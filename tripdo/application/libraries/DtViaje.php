<?php
class DtViaje{
    public $id;
    public $nombre;
    public $descripcion;
    public $publico;
    public $imagen;
    public $realizado;
    public $idUsuario;
    public $valoracion;

    function __construct(){}

    function get_array(){
        $dato = array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion'=>$this->descripcion,
            'publico'=>$this->publico,
            'imagen'=>$this->imagen,
            'realizado'=>$this->realizado,
            'idUsuario'=>$this->idUsuario,
            'valoracion'=>$this->valoracion
        );
        return $dato;
    }
}
?>