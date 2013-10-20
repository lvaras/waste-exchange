<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("success");
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */