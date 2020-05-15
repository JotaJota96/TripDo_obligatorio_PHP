<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->helper(array('main_menu', 'url'));
		
	}

	/**
	 
	 */
	public function index()
	{
		$data['main_menu'] = mainMenu();
		$this->load->view('inicio', $data);
	}
}
