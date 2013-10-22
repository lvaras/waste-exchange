<?php
class Post extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Inserts post into DB
	 * */
	function insert_post()
	{
		$this->db->set('title', $this->input->post('article_name') );
		$this->db->set('text', $this->input->post('article_text') );
		$this->db->set('post_date', date('Y-m-d H:i:s') );
		$this->db->set('mail', $this->input->post('email') );
		$this->db->set('phone', $this->input->post('phone') );
		$this->db->set('address', $this->input->post('address') );
		$this->db->set('building_number', $this->input->post('building_number') );
		// temporanei
		$this->db->set('region', $this->input->post('address') );
		$this->db->set('city', $this->input->post('address') );
		$this->db->set('postal_code', "20099" );
		$this->db->set('category', "4" );
		$this->db->set('publisher', "3" );
		$this->db->insert('post');
		return $this->db->insert_id();
	}
	
	function update_post()
	{
		
	}
	
	/**
	 * get all posts and order them by post date DESC
	 * */
	function get_posts()
	{
		$this->db->order_by("post_date", "desc");
		$query = $this->db->get("post");
		return $query->result_array();
	}
	
	/**
	 * get all posts and order them by post date DESC
	 * */
	function get_unapproved_posts()
	{
		$this->db->where("approved" , "0")->order_by("post_date", "desc");
		$query = $this->db->get("post");
		return $query->result_array();
	}
	
	function get_post( $post_id )
	{
		return $this->db->select()->from('post')->where('id', $post_id)->get()->row();
	}

}