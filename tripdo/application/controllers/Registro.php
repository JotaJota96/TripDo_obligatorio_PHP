<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation')); //Carga la libreria para trabajar con formularios
    }
	/**
	 
	 * 
	 */
	public function index()
	{
		$this->load->view('registro');
	}
}
