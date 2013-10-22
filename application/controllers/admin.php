<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller { 
	
	private $session_data;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper( array('url','form') );
		$this->load->library('session');
		$this->load->model('post');
		$this->session_data = $this->session->all_userdata();
	}
	
	/**
	 * Index...
	 * */
	public function index()
	{
		if( $this->session->userdata('logged_in') === TRUE )
		{
			redirect('/admin/admin_panel', 'refresh');
		}
		else 
		{
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
		}
	}
	
	/**
	 * Log In..
	 * */
	public function login() 
	{
		if($_SERVER['REQUEST_METHOD'] === "POST") 
		{
			if( $_POST["username"] === "admin" && $_POST["password"] == "swag89" ) 
			{
				$user_data = array( 'logged_in' => TRUE );
				$this->session->set_userdata($user_data);
				redirect('/admin/admin_panel', 'refresh');
			}
			else 
			{
				redirect('/admin', 'refresh');
			}
		}
		else
		{
			redirect('/admin', 'refresh');
		}
	}

	/**
	 * admin panel
	 * */
	public function admin_panel() 
	{
		if( $this->session->userdata('logged_in') === FALSE )
		{
			redirect('/admin', 'refresh');
		}
		$data["posts"] = $this->post->get_unapproved_posts();
		$this->load->view('templates/header');
		$this->load->view('admin_panel', $data);
		$this->load->view('templates/footer');
	}
}