<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $data = array();

	public function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->helper(array('main_menu', 'footer', 'url'));				
		$this->data['title'] = 'Iniciar Sesión';
		$this->data['style'] = 'login_style.css';
		$this->data['responsive'] = 'login_responsive.css';
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
        $this->load->view('login', $this->data);
    }

    public function ingresar(){
        $redirigir = $this->input->post('login');
        if ( ! isset($redirigir)) {
            redirect(base_url());
        }
        // se extraen los datos del formulario
        $nickname = $this->input->post('nickname'); // nickname o correo
        $contrasenia = $this->input->post('contrasenia');

        // se intenta iniciar sesion con esos datos
        $nick = $this->MTripDo->iniciarSesion($nickname, $contrasenia);

        // segun si se pudo iniciar sesion...
        if ($nick == null){
            // si no se pudo iniciar sesion
            // puede que los datos esten mal, o que esten bien pero la cuenta no este verificada

            $existeUsuario = $this->MTripDo->existeNickname($nickname) || $this->MTripDo->existeEmail($nickname);
            $cuentaVerificada = $this->MTripDo->usuarioVerificado($nickname);

            // decido si recargar el login, o enviar a pagina de verificacion de cuenta
            if ($existeUsuario && ! $cuentaVerificada){
                // el usuario existe pero no esta verificado
                redirect(base_url('/loginValidar'));
            }else{
                // si los datos son incorrectos
                $this->data['loginFailed'] = true;
                $this->load->view('login', $this->data);
            }
        }else{
            // si se puede iniciar sesion
            // guarda el nickname en la sesion
            $this->session->set_userdata('nickname', $nick);

            // verifico si se debe redirigir a una ruta especifica
            if ($this->session->has_userdata('redirigir-a')){
                // obtengo la ruta y redirijo a ella
                $url = $this->session->userdata('redirigir-a');
                redirect(base_url($url));
            }
            // sno redirige a la pagina de inicio
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
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s caracteres.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('login', $this->data);
		}else{
            $this->ingresar();
		}
	}
}