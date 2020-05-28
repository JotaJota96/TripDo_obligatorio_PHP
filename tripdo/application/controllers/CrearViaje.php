<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrearViaje extends CI_Controller {
 
	public $data = array();

    function __construct(){
		parent::__construct();
		$this->load->model('MTripDo');
		$this->load->library('DtViaje');
		$this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'footer', 'url','html'));		
		$this->data['title'] = 'Crear Viaje';
		$this->data['style'] = 'crear_viaje_style.css';
		$this->data['responsive'] = 'crear_viaje_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);

		$this->data['defNombre'] =$this->input->post('nombreViaje');
		$this->data['defDescripcion'] =$this->input->post('descripcion');
    }

	public function index(){	
		// si hay una sesion iniciada, redirige a la pagina de inicio
        if (!$this->session->has_userdata('nickname')){
            redirect(base_url());
		}
		$this->load->view('crear_viaje', $this->data);		
	}
	public function crear_Viaje(){
		
		$redirigir = $this->input->post('btncrearViaje');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		$dtviaje = new DtViaje();
		$dtviaje->nombre = $this->input->post('nombreViaje');
		$dtviaje->descripcion = $this->input->post('descripcion');
 
		$publico = $this->input->post('publico');

		if($publico=='option1'){
			$dtviaje->publico = false;
		}else{
			$dtviaje->publico = true;
		}

		try {
			$idUsuario = $this->session->userdata('nickname');
			
			$this->MTripDo->crearViaje($dtviaje, $idUsuario);

			//$this->load->view('iiiiiiiiiiiiiiiiiii'); //con esto de-Bugeo!!!

			redirect(base_url());

		} catch (Exception $e) {
			$this->data['exception'] = $e;
			$this->load->view('crear_viaje', $this->data);
		}
	
	}

	public function validate(){

		//Validaciones
		$this->form_validation->set_rules('nombreViaje', 'Nombre Viaje', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s characters.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s characters.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('alpha_dash','El campo %s solo puede contener caracteres alfanuméricos, guiones bajos y guiones.');
		$this->form_validation->set_message('alpha_numeric_spaces','El campo %s solo puede contener caracteres alfanuméricos, números y espacios');

		if($this->form_validation->run() === FALSE){
			$this->load->view('crear_viaje', $this->data);
		}else{
			$this->crear_Viaje();
		}
    }
    
}