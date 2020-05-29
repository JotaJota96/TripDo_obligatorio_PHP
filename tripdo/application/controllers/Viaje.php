<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje extends CI_Controller {

	public $data = array();

	function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library(array('DtViaje', 'DtDestino', 'DtPlan', 'DtTag'));
		$this->load->helper(array('main_menu', 'footer', 'viaje', 'url'));				
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
		
		// ----- FALTA ESTO ------------ //
		$viajeros = $this->MTripDo->obtenerViajerosDeViaje($idViaje);
		$colaboradores = $this->MTripDo->obtenerColaboradoresDeViaje($idViaje);

		// ordeno el log
		ordenarLog($log);

		// paso las variables a la vista
		$this->data['viaje'] = $viaje;
		$this->data['destinos'] = $destinos;
		$this->data['planes'] = $planes;
		$this->data['rol'] = $rol;
		$this->data['log'] = $log;
		$this->data['viajeros'] = $viajeros;
		$this->data['colaboradores'] = $colaboradores;

		$this->load->view('viaje', $this->data);
	}


}
