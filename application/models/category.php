<?php
class Category extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';

	function __construct()
	{
		parent::__construct();
	}

	function get_category_list()
	{
		$query = $this->db->get('entries', 10);
		return $query->result();
	}

	function insert_category()
	{
		
	}

	function update_category()
	{
		
	}

}