<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $data = array();

	public function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'url'));				
		$this->data['title'] = 'Iniciar Sesión';
		$this->data['style'] = 'login_style.css';
		$this->data['responsive'] = 'login_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }
    
	public function index(){
        // si hay una sesion iniciada, redirige a la pagina de inicio
        if ($this->session->has_userdata('nickname')){
            redirect(base_url());
        }
        // sino redirijo al login
        $this->data['mensaje'] = "";
		$this->load->view('login', $this->data);
    }

    public function ingresar(){
        if ( $this->input->post('login') == null) {
            redirect(base_url());
        }
        $nick = $this->input->post('txtnick');
        $pass = $this->input->post('txtpass');

        $nick = $this->MTripDo->iniciarSesion($nick, $pass);
        $this->data['mensaje'] = "";

        if ($nick == null){
            $this->data['mensaje'] = "Usuario o contraseña incorrectos";
            $this->load->view('login', $this->data);
            return;
        }else{
            $this->session->set_userdata('nickname', $nick);
            redirect(base_url());
        }
    }

    public function salir(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function validate(){
		//$rules = getRegisterRules();
		//Validaciones
		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|min_length[5]|max_length[25]');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[4]|max_length[20]');
		
		
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s characters.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s characters.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('login', $this->data);
		}else{

		}
	}
}