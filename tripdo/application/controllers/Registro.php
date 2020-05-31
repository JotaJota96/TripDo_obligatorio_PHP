<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {
 
	public $data = array();


    function __construct(){
		parent::__construct();
		$this->load->model('MTripDo');
		$this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
		$this->load->library('DtUsuario');
		$this->load->helper(array('main_menu', 'footer', 'url','html', 'correo'));		
		$this->data['title'] = 'Registro';
		$this->data['style'] = 'registro_style.css';
		$this->data['responsive'] = 'registro_responsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);

		$this->data['defBiog'] =$this->input->post('biografia');
		$this->data['defTel'] =$this->input->post('telefono');
		$this->data['defApellido'] =$this->input->post('apellido');
		$this->data['defNombre'] =$this->input->post('nombre');
		$this->data['defEmail'] =$this->input->post('email');
		$this->data['defNick'] =$this->input->post('nickname');

		$this->data['msgFoto'] ="";

    }

	public function index(){
		// si hay una sesion iniciada, redirige a la pagina de inicio
        if ($this->session->has_userdata('nickname')){
            redirect(base_url());
        }
        // sino redirijo al registro	
		$this->load->view('registro', $this->data);
	
	}

	public function validate(){
		$redirigir = $this->input->post('btnregistrar');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}
		//$rules = getRegisterRules();
		//Validaciones
		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|min_length[5]|max_length[20]|alpha_dash|is_unique[usuario.nickname]');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('contrasenia2', 'Confirmar Contraseña', 'trim|required|min_length[4]|max_length[20]|matches[contrasenia]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[2]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email|max_length[40]|is_unique[usuario.email]');

		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s caracteres.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('valid_email', 'El correo no es válido.');
		$this->form_validation->set_message('matches', 'Las contraseñas no coinciden.');
		$this->form_validation->set_message('alpha', 'El campo %s sólo puede contener caracteres alfabéticos.');
		$this->form_validation->set_message('alpha_dash','El campo %s sólo puede contener caracteres alfanuméricos, guiones bajos y guiones.');
		$this->form_validation->set_message('alpha_numeric_spaces','El campo %s sólo puede contener caracteres alfanuméricos, números y espacios');
		$this->form_validation->set_message('is_unique','Ya existe un usuario con ese %s');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('registro', $this->data);
		}else{
			$this->registrar();
		}
	}

	public function registrar(){
		$redirigir = $this->input->post('btnregistrar');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		$dtusuario = new DtUsuario();
		$nick = $this->input->post('nickname');
		$pass = $this->input->post('contrasenia');
		$dtusuario->nickname = $nick;		
		$dtusuario->email = $this->input->post('email');
		$dtusuario->contrasenia = $pass;
		$dtusuario->nombre = $this->input->post('nombre');
		$dtusuario->apellido = $this->input->post('apellido');
		$dtusuario->telefono = $this->input->post('telefono');
		$dtusuario->biografia = $this->input->post('biografia');

		//-------------------aca empieza el tema imagen--------------------------
		
        // Check if file was uploaded without errors
		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$filename = $_FILES["photo"]["name"];
			$filetype = $_FILES["photo"]["type"];
			$filesize = $_FILES["photo"]["size"];
		
			// Verify file extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)){
				$this->data['msgFoto'] ="El archivo debe tener alguno de estos formatos (jpg, jpeg, gif, png)";
				$this->load->view('registro', $this->data);
				return;
				//die("Error: Please select a valid file format.");
			} 
		
			// Verify file size - 5MB maximum
			//$maxsize = 5 * 1024 * 1024;
			$maxsize = 10 * 5000 * 5000; //yo lo cambie para que aguante mas
			if($filesize > $maxsize){
				$this->data['msgFoto'] ="El archivo exede los 5MB";
				$this->load->view('registro', $this->data);
				//die("Error: File size is larger than the allowed limit.");
				return;
			} 
		
			// Verify MYME type of the file
			if(in_array($filetype, $allowed)){
				move_uploaded_file($_FILES["photo"]["tmp_name"], "public/perfiles/" . $nick );
				$dtusuario->imagen = $nick;
			} 
			
		}else{
			$dtusuario->imagen = $nick;
			copy("public/perfiles/UKM", "public/perfiles/" . $nick);
		}
        
		//-------------------termina imagen--------------------------

		try {
			//generar el codigo 
			$codigo = encryptar($nick,$pass);

			//registrar en la bd
			$this->MTripDo->registrarUsuario($dtusuario); //<---descomentame

			//mandar el correo
			enviarCorreoValidar($dtusuario->email, $codigo);

			//redirigir a login validar
			redirect(base_url('/loginValidar'));

		} catch (Exception $e) {
			$this->data['exception'] = $e;
			$this->load->view('registro', $this->data);
		}

	}

	/*
	//Para no saltearme el modle vista controlador
	public function nickname_check($str){
		if ($str == 'test'){
			$this->form_validation->set_message('username_check', 'Nickname ya está en uso.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	*/

}
