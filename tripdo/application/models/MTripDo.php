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
        if ( ! is_string($dtUsuario->nombre) ||
            ! is_string($dtUsuario->apellido) ||
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

    public function validarUsuario($idUsuario){
        if ( ! isset($idUsuario)) {
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con id");
        }
        
        $this->db
            ->set('verificado', true)
            ->where('nickname', $idUsuario)
            ->update('usuario');
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
            ->where('u.contrasenia', $contrasenia)
            ->where('u.verificado', true);
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
    * @return DtViaje
    */
    public function crearViaje($dtViaje, $idUsuario){
        if (!$this->validarObjeto($dtViaje, 'DtViaje')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con id");
        }

        if ( ! isset($dtViaje->nombre) ||
            strcmp($dtViaje->nombre, "") == 0 ||
            ! isset($dtViaje->descripcion) ||
            strcmp($dtViaje->descripcion, "") == 0 ||
            ! isset($dtViaje->imagen) ||
            strcmp($dtViaje->imagen, "") == 0 ||
            ! isset($dtViaje->publico)){
                throw new Exception("Hay datos obligatorios sin completar");
        }
        if ( ! is_string($dtViaje->nombre) ||
            ! is_string($dtViaje->descripcion) ||
            ! is_bool($dtViaje->publico)){
                throw new Exception("Hay datos con formato incorrecto");
        }

        // se reasignan dats y se obtiene el array del objeto
        $dtViaje->idUsuario = $idUsuario;
        $viaje = $dtViaje->get_array();
        // se remueven datos
        unset($viaje['id']);
        unset($viaje['realizado']);
        unset($viaje['valoracion']);

        $this->db->insert('viaje', $viaje);
        $idInsertado = $this->db->insert_id();
        return $this->obtenerViaje($idInsertado);
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema vincula al usuario con el viaje como colaborador
    * @param string $idUsuario id del usuario que se desa vincular
    * @param int $idViaje id del viaje que se desea vincular
    * @return void
    */
    public function agregarColaboradorAViaje($idViaje, $idUsuario){
        if (!$this->existeViaje($idViaje)){
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
        if (!$this->existeViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con ese id");
        }
        if($this->esColaborador($idViaje, $idUsuario)){
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
    * el sistema agrega el destino y sus tags a un viaje. Devuelve el destino creado o una Excepcion si ocurre un problema
    * @param DtDestino $dtDestino datos del destino a agregar a un viaje
    * @param string $idViaje id del viaje al cual se le agrega el destino
    * @param string $idUsuario id del usuario que sugiere el destino
    * @param array $arrTags tags (strings) que el usuario asocia al destino
    * @return DtDestino
    */
    public function agregarDestinoAViaje($dtDestino, $idViaje, $idUsuario, $arrTags){
        if ( !isset($idUsuario) || strlen($idUsuario) == 0 || !isset($idViaje)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        if (!$this->validarObjeto($dtDestino, 'DtDestino')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->existeViaje($idViaje)){
            throw new Exception("El viaje no existe");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con ese id");
        }
        if (!$this->esPropietario($idViaje, $idUsuario) && !$this->esViajero($idViaje, $idUsuario) && !$this->esColaborador($idViaje, $idUsuario)){
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }

        if ( ! isset($dtDestino->pais) ||
            strcmp($dtDestino->pais, "") == 0 ||
            ! isset($dtDestino->ciudad) ||
            strcmp($dtDestino->ciudad, "") == 0){
                throw new Exception("Hay datos obligatorios sin completar");
        }
        if ( ! is_string($dtDestino->pais) ||
            ! is_string($dtDestino->ciudad)){
                throw new Exception("Hay datos con formato incorrecto");
        }

        // comienzo una transaccion para que si ocurre un error, no queden datos desconectados en la BDD
        // lo hago por el tema de los tags
        $this->db->trans_start();

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
            $dtTag->texto = strtolower($tag);
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
        // finalizo la transaccion
        $this->db->trans_complete();
        
        return $this->obtenerDestino($idDestinoInsertado);; // devuelvo el destino creado
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema agrega el plan al destino. Devuelve el plan creado o una Excepcion si ocurre un problema
    * @param DtPlan $dtplan datos del plan a agregar al destino
    * @param int $idDestino id del destino al cual se le agrega el plan
    * @param string $idUsuario id del usuario que sugiere el plan
    * @return DtPlan
    */
    public function agregarPlanADestino($dtPlan, $idDestino, $idUsuario){
        if ( !isset($idUsuario) || strlen($idUsuario) == 0 || !isset($idDestino)){
            throw new Exception("Alguno de los parametros recibidos esta vacío");
        }
        if (!$this->validarObjeto($dtPlan, 'DtPlan')){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if (!$this->existeNickname($idUsuario)){
            throw new Exception("No existe un usuario con id");
        }
        if (!$this->existeDestino($idDestino)){
            throw new Exception("No existe un usuario con id");
        }
        $idViaje = $this->obtenerDestino($idDestino)->idViaje;
        if (!$this->esPropietario($idViaje, $idUsuario) && !$this->esViajero($idViaje, $idUsuario) && !$this->esColaborador($idViaje, $idUsuario)){
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }
        
        if (! isset($dtPlan->nombre) ||
            ! isset($dtPlan->descripcion) ||
            ! isset($dtPlan->latitud) ||
            ! isset($dtPlan->longitud) ||
            strcmp($dtPlan->nombre, "") == 0 ||
            strcmp($dtPlan->descripcion, "") == 0 ||
            strcmp($dtPlan->latitud, "") == 0 ||
            strcmp($dtPlan->longitud, "") == 0){
                throw new Exception("Hay datos obligatorios sin completar");
        }

        if (! is_string($dtPlan->nombre) ||
            ! is_string($dtPlan->descripcion) ||
            ! is_numeric($dtPlan->latitud) ||
            ! is_numeric($dtPlan->longitud) ||
            (isset($dtPlan->link) && ! is_string($dtPlan->link))){
                throw new Exception("Hay datos con formato incorrecto");
        }

        // verifico rango de latitud y longitud
        $lat = $dtPlan->latitud;
        $lon = $dtPlan->longitud;
        // Latitud: -90 <= lat <= 90
        // longitud: -180 <= lon <= 180
        if ( !(-90 <= $lat && $lat <= 90 && -180 <= $lon && $lon <= 180)){
            throw new Exception("Latitud o longitud fuera de rango");
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

        // obtenog el ID insertado
        $idPlanInsertado = $this->db->insert_id();
        // retorno el DtPlan insertado
        return $this->obtenerPlan($idPlanInsertado);
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
        $dtd = $this->obtenerDestino($idDestino);
        if ($dtd->idViaje != $idViaje){
            throw new Exception("El destino no pertenece al viaje");
        }

        $filas = $this->db
            ->select('*')
            ->from('destinovotado dv')
            ->where('dv.idUsuario', $idUsuario)
            ->where('dv.idViaje', $idViaje)
            ->where('dv.idDestino', $idDestino)
            ->get()->result_array();
        
        // si la consulta anterior devuelve un resultado, el destino ya fue votado por el usuario asi que no se hace nada
        if (count($filas) == 1){
            return;
        }
        
        // INSERT en la BDD
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
        $dtp = $this->obtenerPlan($idPlan);
        $dtd = $this->obtenerDestino($dtp->idDestino);
        if ($dtd->idViaje != $idViaje){
            throw new Exception("El plan no pertenece al viaje");
        }

        $filas = $this->db
            ->select('*')
            ->from('planvotado pv')
            ->where('pv.idUsuario', $idUsuario)
            ->where('pv.idViaje', $idViaje)
            ->where('pv.idPlan', $idPlan)
            ->get()->result_array();
        
        // si la consulta anterior devuelve un resultado, el plan ya fue votado por el usuario asi que no se hace nada
        if (count($filas) == 1){
            return;
        }
        
        // INSERT en la BDD
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
        if (!$this->existeViaje($idViaje)){
            throw new Exception('El viaje no existe');
        }

        $this->db->trans_start();

        // copiado del viaje
        $dtv = $this->obtenerViaje($idViaje);
        $dtv->realizado = false;
        $dtv = $this->crearViaje($dtv, $idUsuario);
        
        // copiado de destinos, tags y planes
        $arrDtd = $this->obtenerDestinosDeViaje($idViaje);
        foreach($arrDtd as $dtd){
            $destinoCopiado = $dtd->get_array();
            unset($destinoCopiado['id']);
            $destinoCopiado['idViaje'] = $dtv->id;
            $destinoCopiado['agregadoPor'] = null;
            $destinoCopiado['fechaAgregado'] = null;

            $this->db->insert('destino', $destinoCopiado);
            $destinoCopiado['id'] = $this->db->insert_id();

            // copiado de tags del destino
            // obtengo los DtTags originales
            $arrDtTags = $this->obtenerTagsDeDestino($dtd->id);

            // si hay algun tag, los copio, sino no, ¿sino que voy a copiar? xD
            if (count($arrDtTags) > 0){
                // como el array que obtuve es de DtTag, lo convierto a un array de arrays asociativos
                $arrTags = array();
                foreach($arrDtTags as $t){
                    array_push($arrTags, $t->get_array());
                }
                // modifico los datos para los tags copiados
                foreach($arrTags as &$t){ // lleva el '&' para que el cambio se mantenga luego del foreach
                    unset($t['id']);
                    $t['idDestino'] = $destinoCopiado['id'];
                }
                $this->db->insert_batch('tag', $arrTags);
            }
            // fin del copiado de tags del destino

            // copiado de los planes del destino
            $arrDtPlanes = $this->obtenerPlanesDeDestino($dtd->id);
            // si hay algun plan, los copio, sino no
            if (count($arrDtPlanes) > 0){
                $arrPlanes = array();
                foreach ($arrDtPlanes as $p){
                    array_push($arrPlanes, $p->get_array());
                }
                foreach($arrPlanes as &$p){
                    unset($p['id']);
                    $p['idDestino'] = $destinoCopiado['id'];
                    $p['agregadoPor'] = null;
                    $p['fechaAgregado'] = null;
                }
                $this->db->insert_batch('plan', $arrPlanes);
            }
        }
        $this->db->trans_complete();
        return $dtv;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema marca el viaje como realizado
    * @param string $idUsuario id del usuario que quiere realizar la accion
    * @param int $idViaje id del viaje que se desea dar por realizado
    * @return void
    */
    public function marcarViajeComoRealizado($idUsuario, $idViaje){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
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
    public function calificarViaje($idUsuario, $idViaje, $valoracion, $texto){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0 || !isset($valoracion)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if ( ! is_numeric($valoracion)){
            throw new Exception("Hay datos con formato incorrecto");
        }
        // la valoracion va de1 a 5
        if ($valoracion < 1 || $valoracion > 5){
            throw new Exception('La valoración está fuera del rango 1 a 5');
        }
        $dtv = $this->obtenerViaje($idViaje);
        if ($dtv->realizado != true){
            throw new Exception('No se puede valorar un viaje aun no realizado');
        }
        if (!$this->esViajero($idViaje, $idUsuario)) {
            throw new Exception('El usuario no tiene los permisos para realizar esta acción');
        }
        if (isset($texto) && strcmp($texto, "") == 0){
            $texto = null;
        }

        if ($this->viajeValorado($idUsuario, $idViaje)){
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

    /**
     * Devuelve true si el usuario ya valoró el viaje especificado
    * @param string $idUsuario ID del usuario que se quiere saber si ya valoro el viaje
    * @param int $idViaje iD del viaje del que se quiere saber si el usuario valoro
    * @return bool
     */
    public function viajeValorado($idUsuario, $idViaje){
        if( !isset($idViaje) || !isset($idUsuario) || strcmp($idUsuario, "") == 0){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        $row = $this->db
            ->select('v.valoracion')
            ->from('viajero v')
            ->where('idUsuario', $idUsuario)
            ->where('idViaje', $idViaje)
            ->get()->row();
        
        return ($row->valoracion != null);
    }


    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve los datos del viaje o Exception si no se encuentra
    * @param int $idViaje id del viaje, cuyos datos seran debueltos
    * @return DtViaje 
    */
    public function obtenerViaje($idViaje){
        if (!isset($idViaje)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeViaje($idViaje)){
            throw new Exception("No existe un viaje con ese id");
        }

        $this->db->select('*');
        $this->db->from('viajevaloracion v');
        $this->db->where('v.id', $idViaje);

        $resultado = $this->db->get();

        if($resultado->num_rows() == 1){
            $r = $resultado->row();
            $dtv = new DtViaje();

            $dtv->id          = (int)    $r->id;
            $dtv->nombre      = (string) $r->nombre;
            $dtv->descripcion = (string) $r->descripcion;
            $dtv->publico     = (bool)   $r->publico;
            $dtv->imagen      = (string) $r->imagen;
            $dtv->realizado   = (bool)   $r->realizado;
            $dtv->idUsuario   = (string) $r->idUsuario;
            $dtv->valoracion  = (bool)   $r->valoracion;

            return $dtv;
        }
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve los datos del destino o Exception si no se encuentra
    * @param int $idDestino id del destino, cuyos datos seran debueltos
    * @return DtDestino 
    */
    public function obtenerDestino($idDestino){
        if (!isset($idDestino)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeDestino($idDestino)){
            throw new Exception("No existe un destino con ese id");
        }

        $this->db->select('*');
        $this->db->from('destino d');
        $this->db->where('d.id', $idDestino);

        $resultado = $this->db->get();

        if($resultado->num_rows() == 1){
            $r = $resultado->row();
            $dtd = new DtDestino();

            $dtd->id            = (int)    $r->id;
            $dtd->pais          = (string) $r->pais;
            $dtd->ciudad        = (string) $r->ciudad;
            $dtd->idViaje       = (int)    $r->idViaje;
            $dtd->agregadoPor   = (string) $r->agregadoPor;
            $dtd->fechaAgregado = (string) $r->fechaAgregado;

            return $dtd;
        }
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve los datos del plan o Exception si no se encuentra
    * @param int $idPlan id del plan, cuyos datos seran debueltos
    * @return DtPlan 
    */
    public function obtenerPlan($idPlan){
        if (!isset($idPlan)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existePlan($idPlan)){
            throw new Exception("No existe un plan con ese id");
        }

        $this->db->select('*');
        $this->db->from('plan p');
        $this->db->where('p.id', $idPlan);

        $resultado = $this->db->get();

        if($resultado->num_rows() == 1){
            $r = $resultado->row();
            $dtp = new DtPlan();

            $dtp->id            = (int)    $r->id;
            $dtp->nombre        = (string) $r->nombre;
            $dtp->descripcion   = (string) $r->descripcion;
            $dtp->latitud       = (float)  $r->latitud;
            $dtp->longitud      = (float)  $r->longitud;
            $dtp->link          = (string) $r->link;
            $dtp->idDestino     = (int)    $r->idDestino;
            $dtp->agregadoPor   = (string) $r->agregadoPor;
            $dtp->fechaAgregado = (string) $r->fechaAgregado;
            if (strcmp($dtp->link, 'null') == 0){
                $dtp->link = null;
            }
            return $dtp;
        }
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los destinos asociados al viaje
    * @param int $idViaje id del viaje, cuyos destinos seran debueltos
    * @return array 
    */
    public function obtenerDestinosDeViaje($idViaje){
        if (!isset($idViaje)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeViaje($idViaje)){
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

            $dtd->id            = (int)    $row['id'];
            $dtd->pais          = (string) $row['pais'];
            $dtd->ciudad        = (string) $row['ciudad'];
            $dtd->idViaje       = (int)    $row['idViaje'];
            $dtd->agregadoPor   = (string) $row['agregadoPor'];
            $dtd->fechaAgregado = (string) $row['fechaAgregado'];

            array_push($ret, $dtd);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los tags asociados al destino
    * @param int $idDestino id del destino, cuyos tags seran debueltos
    * @return array
     */
    public function obtenerTagsDeDestino($idDestino){
        if (!isset($idDestino)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeDestino($idDestino)){
            throw new Exception("No existe un destino con ese id");
        }
        
        $filas = $this->db
            ->select('*')
            ->from('tag')
            ->where('idDestino', $idDestino)
            ->get()->result_array();
        
        // convierto los arrays obtenidos a objetos
        $ret = array();
        foreach ($filas as $row){
            $dtt = new DtTag();

            $dtt->id        = (int)    $row['id'];
            $dtt->texto     = (string) $row['texto'];
            $dtt->idDestino = (string) $row['idDestino'];

            array_push($ret, $dtt);
        }
        return $ret;
    }
    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve todos los palanes asociados al destino
    * @param int $idDestino id del destino, cuyos planes seran debueltos
    * @return array
    */
    public function obtenerPlanesDeDestino($idDestino){
        if (!isset($idDestino)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
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
            $dtp = new DtPlan();

            $dtp->id            = (int)    $row['id'];
            $dtp->nombre        = (string) $row['nombre'];
            $dtp->descripcion   = (string) $row['descripcion'];
            $dtp->latitud       = (float)  $row['latitud'];
            $dtp->longitud      = (float)  $row['longitud'];
            $dtp->link          = (string) $row['link'];
            $dtp->idDestino     = (int)    $row['idDestino'];
            $dtp->agregadoPor   = (string) $row['agregadoPor'];
            $dtp->fechaAgregado = (string) $row['fechaAgregado'];
            if (strcmp($dtp->link, 'null') == 0){
                $dtp->link = null;
            }
            array_push($ret, $dtp);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
     * Devuelve un array de DtUsuario de los viajeros del viaje
     * @param int $idViaje ID del viaje del que se desea obtener la lista de viajeros
     * @return array
     */
    public function obtenerViajerosDeViaje($idViaje){
        if (!isset($idViaje)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeViaje($idViaje)){
            throw new Exception("No existe un destino con ese id");
        }
        $filas = $this->db
            ->select('u.*')
            ->from('viajero v')
            ->join('usuario u', 'u.nickname = v.idUsuario')
            ->where('v.idViaje', $idViaje)
            ->get()->result_array();
        
        // convierto los arrays obtenidos a objetos
        $ret = array();
        foreach ($filas as $row){
            $dtu = new DtUsuario();

            $dtu->nickname    = (string) $row['nickname'];
            $dtu->email       = (string) $row['email'];
            $dtu->contrasenia = (string) $row['contrasenia'];
            $dtu->nombre      = (string) $row['nombre'];
            $dtu->apellido    = (string) $row['apellido'];
            $dtu->telefono    = (string) $row['telefono'];
            $dtu->biografia   = (string) $row['biografia'];
            $dtu->imagen      = (string) $row['imagen'];
            $dtu->verificado  = (bool)   $row['verificado'];

            array_push($ret, $dtu);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
     * Devuelve un array de DtUsuario de los colaboradores del viaje
     * @param int $idViaje ID del viaje del que se desea obtener la lista de colaboradores
     * @return array
     */
    public function obtenerColaboradoresDeViaje($idViaje){
        if (!isset($idViaje)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if (!$this->existeViaje($idViaje)){
            throw new Exception("No existe un destino con ese id");
        }
        $filas = $this->db
            ->select('u.*')
            ->from('colaborador c')
            ->join('usuario u', 'u.nickname = c.idUsuario')
            ->where('c.idViaje', $idViaje)
            ->get()->result_array();
        
        // convierto los arrays obtenidos a objetos
        $ret = array();
        foreach ($filas as $row){
            $dtu = new DtUsuario();

            $dtu->nickname    = (string) $row['nickname'];
            $dtu->email       = (string) $row['email'];
            $dtu->contrasenia = (string) $row['contrasenia'];
            $dtu->nombre      = (string) $row['nombre'];
            $dtu->apellido    = (string) $row['apellido'];
            $dtu->telefono    = (string) $row['telefono'];
            $dtu->biografia   = (string) $row['biografia'];
            $dtu->imagen      = (string) $row['imagen'];
            $dtu->verificado  = (bool)   $row['verificado'];

            array_push($ret, $dtu);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
     * Devuelve un array de strings con cierta cantidad de tags ordenados de mayor a menor cantidad de apariciones
    * @param int $cant cantidad de resultados deseada (la cantidad resultante puede ser menor a la especificada)
    * @return array
     */
    public function obtenerTopTags($cant){
        if ( ! isset($cant)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if ( ! is_numeric($cant)){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        if ( $cant < 1){
            throw new Exception("La cantidad de elementos deseada debe ser mayor a 0");
        }
        /* estilo de la consulta resultante
        SELECT t.texto, count(*) AS contador FROM tag t
        GROUP BY t.texto
        ORDER BY contador DESC
        LIMIT $cant
        */
        $result = $this->db
            ->select("t.texto, count(*) AS contador")
            ->from("tag t")
            ->group_by("t.texto")
            ->order_by("contador", "DESC")
            ->limit($cant)
            ->get()->result_array();
        
        $ret = array();
        foreach ($result as $t){
            array_push($ret, $t['texto']);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------

    public function obtenerMisViajes($idUsuario){
        if (!isset($idUsuario)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }

        $duenio      = array();
        $viajero     = array();
        $colaborador = array();
        
        foreach ($this->obtenerMisViajesPropietario($idUsuario) as $v){
            array_push($duenio, $v);
        }
        foreach ($this->obtenerMisViajesViajero($idUsuario) as $v){
            array_push($viajero, $v);
        }
        foreach ($this->obtenerMisViajesColaborador($idUsuario) as $v){
            array_push($colaborador, $v);
        }

        $ret = array();
        $ret['duenio']      = $duenio;
        $ret['viajero']     = $viajero;
        $ret['colaborador'] = $colaborador;
        return $ret;
    }
    private function obtenerMisViajesPropietario($idUsuario){
        $filas = $this->db
            ->select('id')
            ->from('viaje')
            ->where('idUsuario', $idUsuario)
            ->get()->result_array();
        $ret = array();
        foreach($filas as $f){
            $dtv = $this->obtenerViaje($f['id']);
            array_push($ret, $dtv);
        }
        return $ret;
    }
    //--------------------------------------------------------------------------------
    /**
     * debuelve un array con todos los viajes en los que participo como viajero
     * @param DtUsuario $idUsuario id del usuario
     * @return array
     */
    public function obtenerMisViajesViajero($idUsuario){
        //SELECT v.nombre FROM viaje v join viajero j on v.id = j.idViaje WHERE v.idUsuario = "antonio57"; 
        $filas = $this->db
            ->select('v.id')
            ->from('viaje v')
            ->join('viajero j', 'v.id = j.idViaje')
            ->where('j.idUsuario', $idUsuario)
            ->where('v.idUsuario !=', $idUsuario)
            ->get()->result_array();
        $ret = array();

        foreach($filas as $f){
            $dtv = $this->obtenerViaje($f['id']);
            array_push($ret, $dtv);
        }
        return $ret;
    }
    private function obtenerMisViajesColaborador($idUsuario){
        $filas = $this->db
            ->select('v.id')
            ->from('viaje v')
            ->join('colaborador c', 'v.id = c.idViaje')
            ->where('c.idUsuario', $idUsuario)
            ->where('v.idUsuario !=', $idUsuario)
            ->get()->result_array();
        $ret = array();

        foreach($filas as $f){
            $dtv = $this->obtenerViaje($f['id']);
            array_push($ret, $dtv);
        }
        return $ret;
    }

    //--------------------------------------------------------------------------------
    /**
    * el sistema debuelve un conjunto de DtViaje cuyos tags o nombres coinsidan con las keywords
    * @param array $keyWords conjunto de palabras clave de la busqueda. En caso de que el array este vacio, se devuelven todos los viajes del sistema
    * @return array
    */
    public function buscarPorPalabrasClave($keyWords){
        if ( ! isset($keyWords)){
            throw new Exception("algunos de los parametros recibidos estan vacios");
        }
        if ( ! is_array($keyWords)){
            throw new Exception("El tipo de dato recibido no es válido");
        }
        
        /* Consulta de referencia
        SELECT DISTINCT * 
        FROM viajevaloracion v
        JOIN destino d ON v.id = d.idViaje
        JOIN tag t ON t.idDestino = d.id
        WHERE lower(t.texto) LIKE lower('%keyWords[0]%') OR
        lower(t.texto) LIKE lower('%keyWords[1]%') OR
        lower(t.texto) LIKE lower('%keyWords[2]%')
        */
        $this->db
            ->select('v.*')
            ->distinct()
            ->from('viajevaloracion v')
            ->join('destino d', 'v.id = d.idViaje')
            ->join('tag t', 't.idDestino = d.id');
        foreach ($keyWords as $kw){
            $this->db->or_where("LOWER(t.texto) LIKE LOWER('%$kw%')");
            // algun dia pueden ser útiles...
            // $this->db->or_where("LOWER(d.pais) LIKE LOWER('%$kw%')");
            // $this->db->or_where("LOWER(d.ciudad) LIKE LOWER('%$kw%')");
            // $this->db->or_where("LOWER(v.nombre) LIKE LOWER('%$kw%')");
            // $this->db->or_where("LOWER(v.descripcion) LIKE LOWER('%$kw%')");
        }
        // echo $this->db->get_compiled_select();
        // return null;

        // obtengo el array de arrays asociativos resultantes
        $filas = $this->db->get()->result_array();
        
        $ret = array();
        foreach ($filas as $row){
            // para cada fila se crea un DtViaje y se le rellenan los datos
            $dtv = new DtViaje();
            $dtv->id          = (int)   $row['id'];
            $dtv->nombre      = (string) $row['nombre'];
            $dtv->descripcion = (string) $row['descripcion'];
            $dtv->publico     = (bool)   $row['publico'];
            $dtv->imagen      = (string) $row['imagen'];
            $dtv->realizado   = (bool)   $row['realizado'];
            $dtv->idUsuario   = (string) $row['idUsuario'];
            $dtv->valoracion  = (float)  $row['valoracion'];
            // se agrega el DT al array de resultados SI ES PUBLICO
            if ($dtv->publico){
                array_push($ret, $dtv);
            }
        }
        return $ret;
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
        return (strcmp( $dtv->idUsuario, $idUsuario) == 0);
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
    public function existeViaje($idViaje){
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

    //--------------------------------------------------------------------------------
    /**
    * Devuelve true si existe un usuario con el ID especificado y ademas su cuenta esta verificada, de lo contrario False
    * @param string $id ID (nickname o correo) del usuario del que se desea saber si tiene la cuenta verificada
    * @return boolean
    */
    public function usuarioVerificado($id){
        // Genero la consulta
        // SELECT u.nickname FROM usuario u WHERE ( u.nickname = $id OR u.email = $id ) AND u.verificado = true 
        $this->db->select('u.nickname')->from('usuario u')
            ->group_start()
                ->where('u.nickname', $id)
                ->or_where('u.email', $id)
            ->group_end()
            ->where('u.verificado', true);
        // ejecuto la query
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