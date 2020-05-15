<?php
class mTripDo extends CI_Model {

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
        if ( ! isset($dtUsuario->nickname) ||
            strcmp($dtUsuario->nickname, "") == 0 ||
            ! isset($dtUsuario->email) ||
            strcmp($dtUsuario->email, "") == 0 ||
            ! isset($dtUsuario->contrasenia) ||
            strcmp($dtUsuario->contrasenia, "") == 0 ||
            ! isset($dtUsuario->nombre) ||
            strcmp($dtUsuario->nombre, "") == 0 ||
            ! isset($dtUsuario->apellido) ||
            strcmp($dtUsuario->apellido, "") == 0){
                throw new Exception("Hay datos obligatorios sin completar");
        }
        if (is_numeric($dtUsuario->nombre) ||
            is_numeric($dtUsuario->apellido) ||
            ! filter_var($dtUsuario->email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Hay datos con formato incorrecto");
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
    public function iniciarSesion($id, $contrasenia){
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
        if (!$this->validarObjeto($dtViaje, 'DtViaje')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con id");
        }

        // se reasignan dats y se obtiene el array del objeto
        $dtViaje->idUsuario = $idUsuario;
        $viaje = $dtViaje->get_array();

        // se remueven datos
        unset($viaje['id']);
        unset($viaje['realizado']);
        unset($viaje['valoracion']);

        $this->db->insert('viaje', $viaje);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema vincula al usuario con el viaje como colaborador
    * @param string $idUsuario id del usuario que se desa vincular
    * @param int $idViaje id del viaje que se desea vincular
    * @return void
    */
    public function agregarColaboradorAViaje($idViaje, $idUsuario){
        if (!$this->existeIdViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con ese id");
        }
        if($this->esViajero($idViaje, $idUsuario)){
            throw new Exception("El usuario no puede agregarse como colaborador porque es viajero");
        }
        if($this->esColaborador($idViaje, $idUsuario)){
            return;
        }
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
        if (!$this->existeIdViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con ese id");
        }
        if($this->esColavorador($idViaje, $idUsuario)){
            throw new Exception("El usuario no puede agregarse como viajero porque es colaborador");
        }
        if($this->esViajero($idViaje, $idUsuario)){
            return;
        }

        $viajero= array(
            'idUsuario'=> $idUsuario,
            'idViaje'=>$idViaje
        );

        $this->db->insert('viajero', $viajero);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema agrega el destino a un viaje
    * @param DtDestino $dtDestino datos del destino a agregar a un viaje
    * @param string $idViaje id del viaje al cual se le agrega el destino
    * @param string $idUsuario id del usuario que sugiere el destino
    * @param array $arrTags tags (strings) que el usuario asocia al destino
    * @return void
    */
    public function agregarDestinoAViaje($dtDestino, $idViaje, $idUsuario, $arrTags){
        if ( !isset($idUsuario) || strlen($idUsuario) == 0 || !isset($idViaje)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        if (!$this->validarObjeto($dtDestino, 'DtDestino')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->esViaje($idViaje)){
            throw new Exception("El viaje no existe");
        }
        if (!$this->esPropietario($idUsuario) && !$this->esViajero($idViaje, $idUsuario) && !$this->esColaborador($idViaje, $idUsuario)){
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }

        // INSERT en 'destino'
        // reasigno valores
        $dtDestino->idViaje = $idViaje;
        $dtDestino->agregadoPor = $idUsuario;
        // obtengo el array del objeto
        $arrDestino = $dtDestino->get_array();
        // quito valores autogenerados
        unset($arrDestino['id']);
        unset($arrDestino['fechaAgregado']);
        // mando el insert
        $this->db->insert('destino', $arrDestino);

        // obtengo el ID del destino insertado para poder referenciar los tags
        $idDestinoInsertado = $this->db->insert_id();

        // INSERT en 'tag'
        // declaro array con los todos los tags a insertar
        $insertTags = array();
        // recorro los tags recibidos creando los objetos para insertar
        foreach($arrTags as $tag){
            // creo objeto DtTag
            $dtTag = new DtTag();
            $dtTag->texto = $tag;
            $dtTag->idDestino = $idDestinoInsertado;
            // obtengo su array
            $tagArr = $dtTag->get_array();
            // le saco el ID porque lo genera la Base de Datos
            unset($tagArr['id']);
            // lo agrego al array
            array_push($insertTags, $tagArr);
        }

        if (count($insertTags) > 0){
            $this->db->insert_batch('tag', $insertTags);
        }
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
        if (!$this->validarObjeto($dtPlan, 'DtPlan')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con id");
        }
        if (!$this->existeDestino($idDestino)){
            throw new Exception("No existe un usuario con id");
        }
        // reasigno datos
        $dtPlan->idDestino = $idDestino;
        $dtPlan->agregadoPor = $idUsuario;
        // obtengo el array del objeto
        $Plan = $dtPlan->get_array();
        // remuevo lo generado por la base de datos
        unset($Plan['id']);
        unset($Plan['fechaAgregado']);
        // mando insert
        $this->db->insert('plan', $Plan);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema registra que un usuario voto por un cierto destino
    * @param string $idUsario id del usuario que vota 
    * @param int $idViaje id del viaje del que es parte el destino que se pretende votar
    * @param int $idDestino id del destino votado
    * @return void
    */
    public function votarDestino($idUsuario, $idViaje, $idDestino){
        if ( !isset($idUsuario) || strlen($idUsuario) == 0 || !isset($idViaje) || !isset($idDestino)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        if (!$this->esViajero($idViaje, $idUsuario)) {
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }
        if (!$this->existeDestino($idDestino)){
            throw new Exception("El destino no existe");
        }
        
        $datos = array(
            "idUsuario" => $idUsuario,
            "idViaje" => $idViaje,
            "idDestino" => $idDestino
        );
        $this->db->insert('destinovotado', $datos);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema registra que un usuario voto por un cierto plan
    * @param string $idUsuario id del usuario que vota 
    * @param int $idViaje id del viaje del que es parte el plan que se pretende votar
    * @param int $idPlan id del plan votado
    * @return void
    */
    public function votarPlan($idUsuario, $idViaje, $idPlan){
        if ( !isset($idUsuario) || strlen($idUsuario) == 0 || !isset($idViaje) || !isset($idPlan)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        if (!$this->esViajero($idViaje, $idUsuario)){
            throw new Exception("El usuario no es viajero del viaje");
        }
        if (!$this->existePlan($idPlan)){
            throw new Exception("No existe un plan con ese id");
        }

        $voto= array(
            'idUsuario'=>$idUsuario,
            'idViaje'=>$idViaje,
            'idPlan'=>$idPlan
        );

        $this->db->insert('planvotado', $voto);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema realiza una compia de los datos del viaje inclullendo sus destinos
    * planes y tags y se los asugan al usuario que realiza la copia
    * @param string $idUsuario id del usuario que realiza la copia
    * @param int $idViaje id del viaje que se desea copiar
    * @return DtViaje
    */
    public function copiarViaje($idUsuario, $idViaje){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception('El usuario no existe');
        }
        if (!$this->existeIdViaje($idViaje)){
            throw new Exception('El usuario no existe');
        }
        // copiado del viaje
        $dtv = $this->obtenerViaje($idViaje);
        $dtv = $this->crearViaje($dtv, $idUsuario);
        
        // copiado de destinos, tags y planes
        $arrDtd = $this->obtenerDestinos($idViaje);
        foreach($arrDtd as $dtd){
            echo "copiando $dtd->id";
            $destinoCopiado = $dtd->get_array();
            unset($destinoCopiado['id']);
            $destinoCopiado['agregadoPor'] = null;
            $destinoCopiado['fechaAgregado'] = null;

            $this->db->insert('destino', $destinoCopiado);
            $destinoCopiado['id'] = $this->db->insert_id();

            // copiado de tags del destino
            // obtengo los tags originales
            $arrTags = $this->db
                ->select('*')
                ->from('tag')
                ->where('idDestino', $dtd->id)
                ->get()->result_array();
            // si hay algun tag, los copio, sino no, ¿sino que voy a copiar? xD
            if (count($arrTags) > 0){
                foreach($arrTags as &$t){
                    unset($t['id']);
                    $t['idDestino'] = $destinoCopiado['id'];
                }
                $this->db->insert_batch('tag', $arrTags);
            }

            // copiado de los planes del destino
            $arrPlanes = $this->db
                ->select('*')
                ->from('plan')
                ->where('idDestino', $dtd->id)
                ->get()->result_array();
            // si hay algun plan, los copio, sino no
            if (count($arrPlanes) > 0){
                foreach($arrPlanes as &$p){
                    unset($p['id']);
                    $p['idDestino'] = $destinoCopiado['id'];
                    $p['agregadoPor'] = null;
                    $p['fechaAgregado'] = null;
                }
                $this->db->insert_batch('plan', $arrPlanes);
            }
        }
        return $dtv;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema marca el viaje como realizado
    * @param string $idUsuario id del usuario propietario del viaje
    * @param int $idViaje id del viaje que se desea dar por realizado
    * @return void
    */
    public function marcarViajeComoRealizado($idUsuario, $idViaje){
        if (!$this->esPropietario($idViaje, $idUsuario)){
            throw new Exception("El usuario no es propietario del viaje");
        }
        $this->db->set('realizado', true);
        $this->db->where('id', $idViaje);
        $this->db->update('viaje');
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
        if( !isset($idViaje) || !isset($idUsuario) || stcmp($idUsuario, "") == 0 || !isset($valoracion)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if ($valoracion < 1 || $valoracion > 5){
            throw new Exception('La valoración está fuera del rango 1 a 5');
        }
        if (!$this->esViajero($idViaje, $idUsuario)) {
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }
        $dtv = $this->obtenerViaje($idViaje);
        if ($dtv->realizado != true){
            throw new Exception('No se puede valorar un viaje aun no realizado');
        }

        // verifico si el usuario ya valoró el viaje anteriormente
        $row = $this->db
            ->select('v.valoracion')
            ->from('viajero v')
            ->where('idUsuario', $idUsuario)
            ->where('idViaje', $idViaje)
            ->get()->row();
        
        if ($row->valoracion != null){
            throw new Exception('El usuario ya ha valorado el viaje anteriormente');
        }

        // preparo el UPDATE
        if (isset($texto) && strlen($texto) == 0){
            $texto = null;
        }
        $datos = array(
            "valoracion" => $valoracion,
            "texto" => $texto
        );
        $this->db->where('idUsuario', $idUsuario);
        $this->db->where('idViaje', $idViaje);
        $this->db->update('viajero', $datos);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los palanes asociados al destino
    * @param int $idDestino id del destino, cuyos planes seran debueltos
    * @return array
    */
    public function obtenerPlanes($idDestino){
        if (!$this->existeDestino($idDestino)){
            throw new Exception("No existe un destino con ese id");
        }
        // obtengo un array de arrays, cada array es una fila del resultado
        $filas = $this->db
            ->select('*')
            ->from('plan p')
            ->where('p.idDestino', $idDestino)
            ->get()->result_array();
        
        // convierto los arrays obtenidos a objetos
        $ret = array();
        foreach ($filas as $row){
            $dtp = new DtDestino();

            $dtp->id = $row['id'];
            $dtp->nombre = $row['nombre'];
            $dtp->descripcion = $row['descripcion'];
            $dtp->latitud = $row['latitud'];
            $dtp->longitud = $row['longitud'];
            $dtp->link = $row['link'];
            $dtp->idDestino = $row['idDestino'];
            $dtp->agregadoPor = $row['agregadoPor'];
            $dtp->fechaAgregado = $row['fechaAgregado'];
            array_push($ret, $dtp);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los destinos asociados al viaje
    * @param int $idViaje id del viaje, cuyos destinos seran debueltos
    * @return array 
    */
    public function obtenerDestinos($idViaje){
        if (!isset($idViaje)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!esViaje($idViaje)){
            throw new Exception("El viaje no existe");
        }
        // obtengo un array con las filas del resultado, cada fila obtenida es un array asociativo
        $filas = $this->db
            ->select('*')
            ->from('destino d')
            ->where('d.idViaje', $idViaje)
            ->get()->result_array();
        
        // convierto cada array asociativo obtenido a un objeto
        $ret = array();
        foreach ($filas as $row){
            $dtd = new DtDestino();
            $dtd->id = $row['id'];
            $dtd->pais = $row['pais'];
            $dtd->ciudad = $row['ciudad'];
            $dtd->idViaje = $row['idViaje'];
            $dtd->agregadoPor = $row['agregadoPor'];
            $dtd->fechaAgregado = $row['fechaAgregado'];
            array_push($ret, $dtd);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve los datos del viaje o null si no se encuentra
    * @param int $idViaje id del viaje, cuyos datos seran debueltos
    * @return DtViaje 
    */
    public function obtenerViaje($idViaje){

        /*
        if (!$this->existeIdViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }

        $this->db->select('*');
        $this->db->from('viajevaloracion v');
        $this->db->where('v.id', $idViaje);

        $resultado = $this->db->get();

        if($resultado->num_rows() == 1){
            $r = $resultado->row();
            $viaje = array(
                'id'=>$r->id,
                'nombre'=>$r->nombre,
                'descripcion'=>$r->descripcion,
                'publico'=>$r->publico,
                'realizado'=>$r->realizado,
                'idUsuario'=>$r->idUsuario,
                'valoracion'=>$r->valoracion
            );
            return $viaje;
        }
        */
    }

    //--------------------------------------------------------------------------------
    /**
    * retorna true si el usuario es propietario del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool 
    */
    public function esPropietario($idViaje, $idUsuario){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        $dtv = $this->obtenerViaje($idViaje);
        return ($dtv->idUsuario == $idUsuario);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve true si el usuario es viajero del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool
    */
    public function esViajero($idViaje, $idUsuario){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        $this->db->select('*');
        $this->db->from('viajero v');
        $this->db->where('v.idUsuario', $idUsuario);
        $this->db->where('v.idViaje', $idViaje);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve true si el usuario es colaborador del viaje, false de los contrario
    * @param int $idViaje id del viaje 
    * @param string $idUsuario id del usuario
    * @return bool
    */
    public function esColaborador($idViaje, $idUsuario){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
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
        
        /*$filas = $this->db
            ->select('*')
            ->from('viajevaloracion v')
            ->where('v.nombre', $keyWords)
            ->get()->result_array();
        
        $ret = array();
        foreach ($filas as $row){
            $dtv = new DtViaje();

            $dtv->id = $row['id'];
            $dtv->nombre = $row['nombre'];
            $dtv->descripcion = $row['descripcion'];
            $dtv->publico = $row['publico'];
            $dtv->realizado = $row['realizado'];
            $dtv->idUsuario = $row['idUsuario'];
            $dtv->idDestino = $row['idDestino'];
            $dtv->valoracion = $row['valoracion'];
   
            array_push($ret, $dtv);
        }
        return $ret; */ 
    }
    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve un conjunto de viajes cuyos tags o nombres coinsidan con las keywords
    * @param array $keyWords conjunto de palabras clave de la busqueda
    * @return array
    */
    public function existePlan($idPlan){
        $this->db->select('p.id');
        $this->db->from('plan p');
        $this->db->where('p.id', $idPlan);
        $result = $this->db->get();
        return ($result->num_rows() == 1);
    }

    //--------------------------------------------------------------------------------
    /**
    * Devuelve TRUE si el id pasado como parametro ya se encuentra en uso
    * @param int $idViaje id del viaje
    * @return boolean
    */
    public function existeDestino($idDestino){
        $this->db->select('d.id');
        $this->db->from('destino d');
        $this->db->where('d.id', $idDestino);
        $result = $this->db->get();
        return ($result->num_rows() == 1);
    }

    //--------------------------------------------------------------------------------
    /**
    * Devuelve TRUE si el id pasado como parametro ya se encuentra en uso
    * @param int $idViaje id del viaje
    * @return boolean
    */
    public function existeIdViaje($idViaje){
        $this->db->select('v.id');
        $this->db->from('viaje v');
        $this->db->where('v.id', $idViaje);
        $result = $this->db->get();
        return ($result->num_rows() == 1);
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
        if (is_null($ingresado) || strcmp(gettype($ingresado), "object") != 0){
            return false;
        }
        if (strcmp(get_class($ingresado), $esperado) != 0){
            return false;
        }
        return true;
    }

}
?>