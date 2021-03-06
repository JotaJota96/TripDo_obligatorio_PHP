<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public $data = array();

	public function __construct(){
        parent:: __construct();
		$this->load->helper(array('main_menu', 'footer', 'url', 'correo'));				
		$this->data['title'] = 'Incio';
		$this->data['style'] = 'inicio_style.css';
		$this->data['responsive'] = 'inicio_responsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		
	}

	/**
	 
	 */
	public function index(){

		$this->load->view('inicio', $this->data);
	}
}
