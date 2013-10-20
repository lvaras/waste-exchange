<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post');
		$this->load->model('files');
		$this->load->helper('url');
	}

	/**
	 * Carico vista relativa a un post dato un id passato come parametro
	 * @param id ( post id )
	 * */
	public function single_post( $post_id )
	{
		$data["post"] = $this->post->get_post( $post_id );
		$data["images"] = $this->files->get_post_images( $post_id );
		$this->load->view('templates/header');
		$this->load->view('single_post.php', $data);
		$this->load->view('templates/footer');
	}
	
	
}
