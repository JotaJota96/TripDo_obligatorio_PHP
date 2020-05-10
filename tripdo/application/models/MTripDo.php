<?php
class MTripDo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('DtDestino');
        $this->load->library('DtPlan');
        $this->load->library('DtTag');
        $this->load->library('DtUsuario');
        $this->load->library('DtViaje');
        $this->load->library('DtViajero');
    }
    
    //--------------------------------------------------------------------------------
    /**
     * Registra un nuevo usuario en el sistema
     * @param DtUsuario $dtUsuario Datos del usuario a registrar
     * @return void
     */
    public function registrarUsuario($dtUsuario){
        if (!$this->validarObjeto($dtUsuario, 'DtUsuario')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if ($this->existeNickname($dtUsuario->nickname) || $this->existeEmail($dtUsuario->email)){
            throw new Exception("Ya existe un usuario con ese nickname o email");
        }
        $dtUsuario->verificado = false;
        $this->db->insert('usuario', $dtUsuario->get_array());
    }

    //--------------------------------------------------------------------------------
    /**
    * iniciar secion valida el inicio de secion de un usuario. Si los datos son correctos retorna su nickname, de lo contrario NULL
    * @param string $id puede ser el nickname o el correo
    * @param string $contrasenia contrasenia del usuario
    * @return string 
    */
    public function iniciarSecion($id, $contrasenia){
        if ((!isset($id) || strlen($id) == 0) || (!isset($contrasenia) || strlen($contrasenia) == 0)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        // Genero la consulta
        // SELECT u.nickname FROM usuario u WHERE ( u.nickname = $id OR u.email = $id ) AND u.contrasenia = $contrasenia 
        $this->db->select('u.nickname')->from('usuario u')
            ->group_start()
                ->where('u.nickname', $id)
                ->or_where('u.email', $id)
            ->group_end()
            ->where('u.contrasenia', $contrasenia);
        // ejecuto la query
        $result = $this->db->get();

        if ($result->num_rows() == 1){
            $r = $result->row();
            $resultNick = $r->nickname;
            return $resultNick;
        }else{
            return NULL;
        }
        
    } 

    //--------------------------------------------------------------------------------
    /**
    * registra un viaje en el sistema
    * @param DtViaje $dtViaje datos del viaje que se desea rejistrar
    * @param string $idUsuario id del propietario del viaje
    * @return void
    */
    public function crearViaje($dtViaje, $idUsuario){
        
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema vincula al usuario con el viaje como colaborador
    * @param string $idUsuario id del usuario que se desa vincular
    * @param int $idViaje id del viaje que se desea vincular
    * @return void
    */
    public function agregarColaboradorAViaje($idViaje, $idUsuario){
        echo "descomentar en agregarColaboradorAViaje";
        /* DESCOMENTAR
        if (!$this->existeIdViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }
        */
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con ese id");
        }
        /* DESCOMENTAR
        if($this->esViajero($idViaje, $idUsuario)){
            throw new Exception("El usuario no puede agregarse como colaborador porque es viajero");
        }
        if($this->esColaborador($idViaje, $idUsuario)){
            return;
        }
        */
        $colaborador= array(
            'idUsuario'=> $idUsuario,
            'idViaje'=>$idViaje
        );
        $this->db->insert('colaborador', $colaborador);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema vincula al usuario con el viaje como viajero del viaje
    * @param string $idUsuario id del usuario que se desa vincular
    * @param int $idViaje id del viaje que se desea vincular
    * @return void
    */
    public function agregarViajeroAViaje($idViaje, $idUsuario){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema agrega el destino a un viaje
    * @param DtDestino $dtDestino datos del destino a agregar a un viaje
    * @param string $idViaje id del viaje al cual se le agrega el destino
    * @param string $idUsuario id del usuario que sugiere el destino
    * @return void
    */
    public function agregarDestinoAViaje($dtDestino, $idViaje, $idUsuario){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema agrega el plan al destino
    * @param DtPlan $dtplan datos del plan a agregar al destino
    * @param int $idDestino id del destino al cual se le agrega el plan
    * @param string $idUsuario id del usuario que sugiere el plan
    * @return void
    */
    public function agregarPlanADestino($dtPlan, $idDestino, $idUsuario){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema registra que un usuario voto por un cierto destino
    * @param string $idUsario id del usuario que vota 
    * @param int $idViaje id del viaje del que es parte el destino que se pretende votar
    * @param int $idDestino id del destino votado
    * @return void
    */
    public function votarDestino($idUsario, $idViaje, $idDestino){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema registra que un usuario voto por un cierto plan
    * @param string $idUsario id del usuario que vota 
    * @param int $idViaje id del viaje del que es parte el plan que se pretende votar
    * @param int $idPlan id del plan votado
    * @return void
    */
    public function votarPlan($idUsario, $idViaje, $idPlan){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema realiza una compia de los datos del viaje inclullendo sus destinos
    * planes y tags y se los asugan al usuario que realiza la copia
    * @param string $idUsuario id del usuario que realiza la copia
    * @param int $idViaje id del viaje que se desea copiar
    * @return void
    */
    public function copiarViaje($idUsuario, $idViaje){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema marca el viaje como realizado
    * @param string $idUsuario id del usuario propietario del viaje
    * @param int $idViaje id del viaje que se desea dar por realizado
    * @return void
    */
    public function marcarViajeComoRealizado($idUsuario, $idViaje){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema registra la calificacion y texto (opcional) dada por un usuario a un viaje
    * @param string $idUsuario id del usuario que realiza la calificacion
    * @param int $idViaje id del viaje calificado por el usuario
    * @param int $valoracion valoracion dada por el usuario al viaje, de 1 a 5
    * @param string $texto comentario asignado a la valoracion (opcional)
    * @return void
    */
    public function calificarViaje($idUsuario, $idViaje, $valoracion, $texto=null){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los palanes asociados al destino
    * @param int $idDestino id del destino, cuyos planes seran debueltos
    * @return array
    */
    public function obtenerPlanes($idDestino){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los destinos asociados al viaje
    * @param int $idViaje id del viaje, cuyos destinos seran debueltos
    * @return array 
    */
    public function obtenerDestinos($idViaje){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve los datos del viaje o null si no se encuentra
    * @param int $idViaje id del viaje, cuyos datos seran debueltos
    * @return DtViaje 
    */
    public function obtenerViaje($idViaje){

    }

    //--------------------------------------------------------------------------------
    /**
    * retorna true si el usuario es propietario del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool 
    */
    public function esPropietario($idViaje, $idUsuario){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve true si el usuario es viajero del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool
    */
    public function esViajero($idViaje, $idUsuario){

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve true si el usuario es colaborador del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool
    */
    public function esColaborador($idViaje, $idUsuario){
        if( !isset($idViaje) || !isset($idUsuario) || $idUsuario==""){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        $this->db->select('*')
            ->from('colaborador c')
            ->where('c.idUsuario', $idUsuario)
            ->where('c.idViaje', $idViaje);
        $result = $this->db->get();

        if($result->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve un conjunto de viajes cuyos tags o nombres coinsidan con las keywords
    * @param array $keyWords conjunto de palabras clave de la busqueda
    * @return array
    */
    public function buscarPorPalabrasClave($keyWords){

    }

    //--------------------------------------------------------------------------------
    /**
    * Devuelve TRUE si el nickname pasado como parametro ya se encuentra en uso
    * @param string $nickname Nickname a verificar
    * @return boolean
    */
    public function existeNickname($nickname){
        $this->db->select('u.nickname');
        $this->db->from('usuario u');
        $this->db->where('u.nickname', $nickname);
        $result = $this->db->get();
        return ($result->num_rows() == 1);
    }

    //--------------------------------------------------------------------------------
    /**
    * Devuelve TRUE si el email pasado como parametro ya se encuentra en uso
    * @param string $email Email a verificar
    * @return boolean
    */
    public function existeEmail($email){
        $this->db->select('u.email');
        $this->db->from('usuario u');
        $this->db->where('u.email', $email);
        $result = $this->db->get();
        return ($result->num_rows() == 1);
    }

    //**********************************************************************************************
    private function validarObjeto($ingresado, $esperado){
        if (is_null($ingresado) || gettype($ingresado) != "object"){
            return false;
        }
        if (get_class($ingresado) != $esperado){
            return false;
        }
        return true;
    }

}
?>