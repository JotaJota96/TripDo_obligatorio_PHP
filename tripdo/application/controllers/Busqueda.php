<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends CI_Controller {
	public $data = array();

	public function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library('DtViaje');
        $this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'footer', 'url'));				
		$this->data['title'] = 'Buscar';
		$this->data['style'] = 'busqueda_style.css';
		$this->data['responsive'] = 'busqueda_responsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }
    
	public function index() {
        $this->data['viajes'] = array();
        // texto ingresado por el usuario (un valor por defecto si el usuario no ha buscado aun)
        $keywords = "";
        // extraigo el array con los parametros de la URL
        $parametros = $this->input->get();
        // si vino el parametro 'keywords' lo extraigo a la variable
        if (isset($parametros['keywords']) && strcmp($parametros['keywords'], "") != 0){
            $keywords = $parametros['keywords'];

            // armo un array de strings con cada palabra recibida
            $arr = explode(" ", $keywords);
    
            // llamo al modelo y me devuelve un array de DtViaje
            $viajes = $this->MTripDo->buscarPorPalabrasClave($arr);

            $this->data['viajes'] = $viajes;
        }
        // pongo en el $data para completar el campo de busqueda en la vista
        $this->data['keywords'] = $keywords;
		$this->load->view('busqueda', $this->data);
	}
}
