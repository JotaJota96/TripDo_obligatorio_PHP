<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginValidar extends CI_Controller {
	public $data = array();

	public function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'footer', 'url', 'correo'));				
		$this->data['title'] = 'Iniciar Sesión';
		$this->data['style'] = 'login_style.css';
		$this->data['responsive'] = 'login_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
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
		$this->load->view('login_validar', $this->data);
    }

    public function ingresar(){
        $redirigir = $this->input->post('login_validar');
        if ( ! isset($redirigir)) {
            redirect(base_url());
        }
        $nickname = $this->input->post('nickname');
        $contrasenia = $this->input->post('contrasenia');
        $codigo = $this->input->post('codigo');

        $preCodigo=encryptar($nickname,$contrasenia);

        if(strcmp($preCodigo, $codigo)==0){

            $this->MTripDo->validarUsuario($nickname);

            $nick = $this->MTripDo->iniciarSesion($nickname, $contrasenia);

            if ($nick == null){
                $this->data['loginFailed'] = true;
                $this->load->view('login_validar', $this->data);
                return;
            }else{
                $this->session->set_userdata('nickname', $nick);
                redirect(base_url());
            }
        }else{
            $this->data['loginFailed'] = true;
            $this->load->view('login_validar', $this->data);
        }

    }

    public function validate(){
        $redirigir = $this->input->post('login_validar');
        if ( ! isset($redirigir)) {
            redirect(base_url());
        }
		//$rules = getRegisterRules();
		//Validaciones
		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('codigo', 'Código', 'trim|required|exact_length[10]');
		
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s characters.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s characters.');
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('exact_length', 'El largo del campo %s debe ser 10.');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('login_validar', $this->data);
		}else{
            $this->ingresar();
		}
	}
}