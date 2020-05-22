<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje extends CI_Controller {

	function __construct(){
        parent::__construct();
		
		$this->load->helper(array('main_menu', 'footer', 'url'));
    }

	/**
	 * 
	 */
	public function index()
	{
		$data['main_menu'] = mainMenu();
		$this->load->view('viaje', $data);
	}
}
