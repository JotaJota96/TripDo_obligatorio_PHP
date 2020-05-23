<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje extends CI_Controller {

	public $data = array();

	function __construct(){
        parent:: __construct();
		$this->load->helper(array('main_menu', 'footer', 'url'));				
		$this->data['title'] = 'Viaje';
		$this->data['style'] = 'viaje_style.css';
		$this->data['responsive'] = 'viaje_reponsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }

	/**
	 * 
	 */
	public function index()
	{
		$this->load->view('viaje', $this->data);
	}
}
