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
		$this->data['responsive'] = 'crear_viaje_responsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		
		$this->data['defNombre']      = $this->input->post('nombreViaje');
		$this->data['defDescripcion'] = $this->input->post('descripcion');
		$this->data['msgFoto'] ="";
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
		$dtviaje->nombre      = $this->input->post('nombreViaje');
		$dtviaje->descripcion = $this->input->post('descripcion');
		$publico              = $this->input->post('publico');

		if($publico=='option1'){
			$dtviaje->publico = false;
		}else{
			$dtviaje->publico = true;
		}

		//-------------------aca empieza el tema imagen--------------------------
        // Check if file was uploaded without errors
		if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0){

			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$filename = $_FILES["imagen"]["name"];
			$filetype = $_FILES["imagen"]["type"];
			$filesize = $_FILES["imagen"]["size"];
		
			// Verify file extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed) || !in_array($filetype, $allowed)){
				$this->data['msgFoto'] ="El archivo debe tener alguno de estos formatos (jpg, jpeg, gif, png)";
				$this->load->view('crear_viaje', $this->data);
				return;
				//die("Error: Please select a valid file format.");
			} 
		
			// Verify file size - 5MB maximum and Verify MYME type of the file
			//$maxsize = 5 * 1024 * 1024;
			$maxsize = 10 * 5000 * 5000; //yo lo cambie para que aguante mas
			if($filesize > $maxsize){
				$this->data['msgFoto'] ="El archivo exede los 5MB";
				$this->load->view('crear_viaje', $this->data);
				//die("Error: File size is larger than the allowed limit.");
				return;
			} 
		}else{
			// Aca nunca deberia entrar porque la imagen es obligatoria
			//$dtusuario->imagen = $nick;
			//copy("public/perfiles/UKM", "public/perfiles/" . $nick);
		}

		//-------------------termina imagen--------------------------

		try {
			$idUsuario = $this->session->userdata('nickname');
			$nuevoNombreArchivo = sha1(date(DATE_RFC2822) . $_FILES["imagen"]["name"] . $idUsuario);
			$dtviaje->imagen = $nuevoNombreArchivo;
			// manda a persistir el viaje y obtengo lo persistido con el ID que le fue asignado
			$dtviaje = $this->MTripDo->crearViaje($dtviaje, $idUsuario);

			// Guarda la imagen
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/viajes/" . $nuevoNombreArchivo );
			$dtusuario->imagen = $nick;

			redirect(base_url('/viaje/ver/'.$dtviaje->id));

		} catch (Exception $e) {
			$this->data['exception'] = $e;
			$this->load->view('crear_viaje', $this->data);
		}
	
	}

	public function validate(){
		$redirigir = $this->input->post('btncrearViaje');
        if ( ! isset($redirigir)) {
            redirect(base_url());
		}

		//Validaciones
		$this->form_validation->set_rules('nombreViaje', 'Nombre del viaje', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required');
		// para que la imagen sea obligatoria
		if (empty($_FILES['imagen']['name'])){
			$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		}


		//Mensajes de error
		$this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
		$this->form_validation->set_message('max_length', 'El campo %s no debe superar los %s caracteres.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('alpha_dash','El campo %s solo puede contener caracteres alfanuméricos, guiones bajos y guiones.');
		$this->form_validation->set_message('alpha_numeric_spaces','El campo %s solo puede contener caracteres alfanuméricos, números y espacios');
		$this->form_validation->set_message('valid_url','El campo %s debe ser una URL a una imagen');

		if($this->form_validation->run() === FALSE){
			$this->load->view('crear_viaje', $this->data);
		}else{
			$this->crear_Viaje();
		}
    }
    
}