<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrearViaje extends CI_Controller {
 
	public $data = array();

    function __construct(){
        parent::__construct();
		$this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'footer', 'url','html'));		
		$this->data['title'] = 'Crear Viaje';
		$this->data['style'] = 'crear_viaje_style.css';
		$this->data['responsive'] = 'crear_viaje_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }
	/**
	 
	 * 
	 */
	public function index()
	{		
		$this->load->view('crear_viaje', $this->data);		
	}

	public function validate(){
		//$rules = getRegisterRules();
		//Validaciones
		$this->form_validation->set_rules('nombreViaje', 'Nombre Viaje', 'trim|required|min_length[5]|max_length[50]|alpha_dash');
		
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|apha_dash');
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s characters.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s characters.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('alpha_dash','El campo %s solo puede contener caracteres alfanuméricos, guiones bajos y guiones.');

		if($this->form_validation->run() === FALSE){
			$this->load->view('crear_viaje', $this->data);
		}else{

		}
    }
    
}