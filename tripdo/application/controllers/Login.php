<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('MTripDo');
    }

	public function index(){
        // si hay una sesion iniciada, redirige a la pagina de inicio
        if ($this->session->has_userdata('nickname')){
            redirect(base_url());
        }
        // sino redirijo al login
        $data['mensaje'] = "";
		$this->load->view('login', $data);
    }
    
    public function ingresar(){
        if ( $this->input->post('login') == null) {
            redirect(base_url());
        }
        $nick = $this->input->post('txtnick');
        $pass = $this->input->post('txtpass');

        $nick = $this->MTripDo->iniciarSesion($nick, $pass);
        $data['mensaje'] = "";

        if ($nick == null){
            $data['mensaje'] = "Usuario o contraseña incorrectos";
            $this->load->view('login', $data);
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
}