<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje extends CI_Controller {
	
	public $data = array();

	function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library(array('DtUsuario','DtViaje', 'DtDestino', 'DtPlan', 'DtTag'));
		$this->load->helper(array('main_menu', 'footer', 'correo', 'viaje', 'url'));				
		$this->data['mapa'] = true;
		$this->data['title'] = 'Viaje';
		$this->data['style'] = 'viaje_style.css';
		$this->data['responsive'] = 'viaje_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }

	public function index(){
		redirect(base_url());
	}

	public function ver($idViaje = 0){
		if ($idViaje == 0){
			redirect(base_url());
		}
		if ( ! $this->MTripDo->existeViaje($idViaje)){
			redirect(base_url());
		}

		$idUsuario = "";
		if ($this->session->has_userdata('nickname')){
			$idUsuario = $this->session->userdata('nickname');
        }

		/**
		 * Cosas que se necesitan para mostrar un viaje:
		 * - Datos basicos del Viaje
		 * - Lista de Destinos
		 * - Lista de Planes para cada destino
		 * - Rol del usuario que visualiza el viaje
		 * - Lista de Viajeros del viaje
		 * - Lista de Colaboradores del viaje
		 * - Listado de actividad reciente (ordenado cronologicamente)
		 */

		// defino el rol del usuario que visualiza el viaje
		$rol = ""; // referencia: "" = visitante, "duenio", "viajero", "colaborador"
		if (strcmp($idUsuario, "") != 0){
			if ($this->MTripDo->esColaborador($idViaje, $idUsuario)){
				$rol = "colaborador";
			}elseif ($this->MTripDo->esPropietario($idViaje, $idUsuario)){
				$rol = "duenio";
			} elseif ($this->MTripDo->esViajero($idViaje, $idUsuario)){
				$rol = "viajero";
			} 
		}

		// obtengo el viaje
		$viaje = $this->MTripDo->obtenerViaje($idViaje);

		// Si el viaje es privado y el usuario no debe verlo, redirije al inicio
		if ( ! $viaje->publico){
			if (strcmp($rol, "") == 0){
				redirect(base_url());
			}
		}

		// defino el array para el log
		$log = array();

		// obtengo la lista de destinos
		$destinos = $this->MTripDo->obtenerDestinosDeViaje($idViaje);
		
		// obtengo cada plan de cada destino y los guardo asociandolos al destino
		// tambien relleno el array del log
		$planes = array();
		foreach ($destinos as $d){
			array_push($log, array("elem" => $d, "tipo" => "destino"));
			$planesDestino = $this->MTripDo->obtenerPlanesDeDestino($d->id);
			$planes[$d->id] = $planesDestino;
			foreach ($planesDestino as $p){
				array_push($log, array("elem" => $p, "tipo" => "plan"));
			}
		}

		$viajeros = $this->MTripDo->obtenerViajerosDeViaje($idViaje);
		$colaboradores = $this->MTripDo->obtenerColaboradoresDeViaje($idViaje);

		// ordeno el log
		ordenarLog($log);
		
		// limpio el log (sirve cuando el viaje es copiado)
		$logLimpio = array();
		foreach ($log as $l){
			if (strcmp($l['elem']->agregadoPor, "") != 0){
				array_push($logLimpio, $l);
			}
		}
		$log = $logLimpio;
		
		// paso las variables a la vista
		$this->data['id'] = $idViaje;
		$this->data['viaje'] = $viaje;
		$this->data['destinos'] = $destinos;
		$this->data['planes'] = $planes;
		$this->data['rol'] = $rol;
		$this->data['log'] = $log;
		$this->data['viajeros'] = $viajeros;
		$this->data['colaboradores'] = $colaboradores;
		$this->data['linkAgregarViajero'] = $this->generarEnlaceInvitacion("v", $idViaje);
		$this->data['linkAgregarColaborador'] = $this->generarEnlaceInvitacion("c", $idViaje);

		$this->load->view('viaje', $this->data);
	}

	public function sugerirDestino(){
		$redirigir = $this->input->post('btnAgregarDestino');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		$dtD = new DtDestino;
		$dtD->pais = $this->input->post('Pais');
		$dtD->ciudad = $this->input->post('Ciudad');
		$dtD->idViaje = $this->input->post('idViaje');
		$dtD->agregadoPor = $this->session->userdata('nickname');

		$tags = array();

		// String con todos los tags separados por coma
		$strTags = $this->input->post('Tags');
		if (isset($strTags) && strcmp($strTags, "") != 0){
			// obtengo los tags como un array de strings
			$tags = explode(",", $strTags);
			// a todos los elementos del array, se le aplica la funcion trim (quita espacios al principio y al final)
			$tags = array_map('trim', $tags);
		}
		
		try {
			$this->MTripDo->agregarDestinoAViaje($dtD, $dtD->idViaje, $dtD->agregadoPor, $tags);
		} catch (Exception $e) {
			$this->data['exception'] = $e;
		}
		redirect(base_url('/viaje/ver/'.$this->input->post('idViaje')));
	}

	public function sugerirPlan(){
		$redirigir = $this->input->post('btnSugerirPlan');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		$dtp = new DtPlan();
		$dtp->nombre      = $this->input->post('titulo');
		$dtp->descripcion = $this->input->post('descripcion');
		$dtp->latitud     = $this->input->post('latitud');
		$dtp->longitud    = $this->input->post('longitud');
		$dtp->link        = $this->input->post('link');
		$dtp->idDestino   = $this->input->post('idDestino');
		$dtp->agregadoPor = $this->session->userdata('nickname');
		
		$idViaje = $this->input->post('idViaje');
		
		try {
			$this->MTripDo->agregarPlanADestino($dtp, $dtp->idDestino, $dtp->agregadoPor);
		} catch (Exception $e) {
			$this->data['exception'] = $e;
		}
		redirect(base_url('/viaje/ver/'.$this->input->post('idViaje')));
	}

	public function copiar(){
		$redirigir = $this->input->post('copiarViaje');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		// obtengo los datos del form
		$idViaje   = $this->input->post('idViaje');
		$idUsuario = $this->session->userdata('nickname');
		
		try {
			$nuevoViaje = $this->MTripDo->copiarViaje($idUsuario, $idViaje);
			redirect(base_url('/viaje/ver/'.$nuevoViaje->id));
		} catch (Exception $e) {
			$this->data['exception'] = $e;
		}
		redirect(base_url('/viaje/ver/'.$this->input->post('idViaje')));
	}


	public function marcarComoRealizado(){
		$redirigir = $this->input->post('btnMarcarComoRealizado');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		// obtengo los datos del form
		$idViaje   = $this->input->post('idViaje');
		$idUsuario = $this->session->userdata('nickname');
		
		try {
			$nuevoViaje = $this->MTripDo->marcarViajeComoRealizado($idUsuario, $idViaje);
			redirect(base_url('/viaje/ver/'.$idViaje));
		} catch (Exception $e) {
			$this->data['exception'] = $e;
		}
		redirect(base_url('/viaje/ver/'.$idViaje));
	}

	public function agregarRol($rol = "", $idViaje = 0, $verificacion = ""){
		// si no viene con parametro
		if ($idViaje == 0 || (strcmp($rol, "v") != 0 && strcmp($rol, "c") != 0) || strcmp($verificacion, "") == 0) {
            redirect(base_url());
		}
		// si no hay usuario logueado
		if ( ! $this->session->has_userdata('nickname')){
			redirect(base_url('/login'));
		}
		// verifico el hash
		if (strcmp($this->generarHash($rol, $idViaje), $verificacion) != 0){
            redirect(base_url());
		}
		$idUsuario = $this->session->userdata('nickname');
		try {
			if (strcmp($rol, "v") == 0){
				$this->MTripDo->agregarViajeroAViaje($idViaje, $idUsuario);
			}elseif (strcmp($rol, "c") == 0){
				$this->MTripDo->agregarColaboradorAViaje($idViaje, $idUsuario);
			}
			redirect(base_url('/viaje/ver/'.$idViaje));
		} catch (Exception $e) {
			$this->data['exception'] = $e;
			echo $e;
            //redirect(base_url());
		}
	}

	public function enviarInvitacion(){
		$redirigir = $this->input->post('btnEnviarInvitacion');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		// obtengo los datos del form
		$enlace       = $this->input->post('enlace');
		$idViaje      = $this->input->post('id');
		$destinatario = $this->input->post('destinatario');;

		if (strpos($enlace, "/v/") > 0){
			enviarCorreoImbitacion($destinatario, "viajero", $enlace);
		}elseif (strpos($enlace, "/c/") > 0) {
			enviarCorreoImbitacion($destinatario, "colaborador", $enlace);
		}
		redirect(base_url('/viaje/ver/'.$idViaje));
	}

	//------------------------------------------------------------------------------
	private function generarEnlaceInvitacion($rol, $idViaje){
		$jash = $this->generarHash($rol, $idViaje);
		if (strcmp($rol, "v")){
			return base_url('/viaje/agregarRol/c/'.$idViaje.'/'.$jash);
		}elseif (strcmp($rol, "c")){
			return base_url('/viaje/agregarRol/v/'.$idViaje.'/'.$jash);
		}
	}
	private function generarHash($rol, $idViaje){
		return sha1(sha1($rol.$idViaje).sha1("Esto es para hacerlo mas seguro"));
	}
}
