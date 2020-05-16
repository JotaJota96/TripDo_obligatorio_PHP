<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('MTripDo');
        $this->load->library('DtDestino');
        $this->load->library('DtPlan');
        $this->load->library('DtTag');
        $this->load->library('DtUsuario');
        $this->load->library('DtViaje');
        $this->load->library('DtViajero');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
        $data = array();
        try {
            /*
            $dtu = new DtUsuario();
            $dtu->nickname = "JotaJota96";
            $dtu->email = "jjap96@gmail.com";
            $dtu->contrasenia = "1234";
            $dtu->nombre = "Juan";
            $dtu->apellido = "Alvarez";
            $this->MTripDo->registrarUsuario($dtu);
            */
            /*
            $dtv = new DtViaje();
            $dtv->nombre = "Viaje al departamento de Rocha";
            $dtv->descripcion = "Un viaje de vagayo";
            $dtv->publico = false;
            var_dump($this->MTripDo->crearViaje($dtv, "JotaJota96"));
            */
            /*
            $dtd = new DtDestino();
            $dtd->pais = "Uruguay";
            $dtd->ciudad = "Rocha";
            $tags = array("tag1", 'tag2', 'tag3');
            var_dump($this->MTripDo->agregarDestinoAViaje($dtd, ?, "JotaJota96", $tags));
            */

        } catch (Exception $e) {
            echo "Excepcion capturada<br>";
            echo $e->getMessage();
        }
		$this->load->view('welcome_message', $data);
	}
}
