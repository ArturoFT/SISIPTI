<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_general extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_usuario');
		$this->load->model('m_usuario');
	}
}
