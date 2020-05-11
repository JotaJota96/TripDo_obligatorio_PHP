<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('MTripDo');
        $this->load->library('DtUsuario');
		$this->load->library('DtViaje');
		$this->load->library('DtPlan');
		$this->load->library('DtTag');
		$this->load->library('DtDestino');
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

		/*
		$dtPlan = new DtPlan();
		$dtPlan->nombre="las bahamas";
		$dtPlan->descripcion="dddd";
		$dtPlan->latitud="32.23";
		$dtPlan->longitud="53.23";
		$this->MTripDo->agregarPlanADestino($dtPlan,1,'antonio57');
		*/
		$arr=$this->MTripDo->obtenerViaje(1);
		echo $arr[0]->nombre;

		$this->load->view('welcome_message', $data);
	}
}
