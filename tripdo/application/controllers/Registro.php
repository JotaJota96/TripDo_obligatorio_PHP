<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {
 
	public $data = array();

    function __construct(){
        parent::__construct();
		$this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'url','html'));		
		$this->data['title'] = 'Registro';
		$this->data['style'] = 'registro_style.css';
		$this->data['responsive'] = 'registro_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }
	/**
	 
	 * 
	 */
	public function index()
	{		
		$this->load->view('registro', $this->data);		
	}

	public function validate(){
		//$rules = getRegisterRules();
		//Validaciones
		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|min_length[5]|max_length[25]|alpha_dash|callback_nickname_check');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('contrasenia2', 'Confirmar Contraseña', 'trim|required|min_length[4]|max_length[20]|matches[contrasenia]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[5]|max_length[20]|alpha');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[3]|max_length[20]|alpha');
		$this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email|callback_email_check');
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s characters.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s characters.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('valid_email', 'El correo no es válido.');
		$this->form_validation->set_message('matches', 'La contraseñas no coinciden.');
		$this->form_validation->set_message('alpha', 'El campo %s solo puede contener caracteres alfabéticos.');
		$this->form_validation->set_message('alpha_dash','El campo %s solo puede contener caracteres alfanuméricos, guiones bajos y guiones.');

		if($this->form_validation->run() === FALSE){
			$this->load->view('registro', $this->data);
		}else{

		}
	}

	public function nickname_check($str){
		if ($str == 'test'){
			$this->form_validation->set_message('username_check', 'Nickname ya está en uso.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public function email_check($test){
		
	}

}
