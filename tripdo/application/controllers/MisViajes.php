<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MisViajes extends CI_Controller {
	public $data = array();

	public function __construct(){
        parent:: __construct();
        $this->load->model('MTripDo');
        $this->load->library('DtViaje');
		$this->load->helper(array('main_menu', 'footer', 'url'));				
		$this->data['title'] = 'Mis viajes';
		$this->data['style'] = 'mis_viajes_style.css';
		$this->data['responsive'] = 'mis_viajes_responsive.css';
		$this->data['main_menu'] = mainMenu();
		$this->data['footerTags'] = footerTags();
		$this->data['header'] = $this->load->view('header', $this->data, TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
    }
    
	public function index() {
        if (!$this->session->has_userdata('nickname')){
            redirect(base_url());
        }

        $nick = $this->session->userdata('nickname');

        $this->data['multiArray'] = $this->MTripDo->obtenerMisViajes($nick );
        $this->load->view('mis_viajes', $this->data);
	}
}
