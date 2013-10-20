<?php

class Files extends CI_Model {
	
	private $upload_folder;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->upload_folder = FCPATH . 'uploads/';
	}
	
	/**
	 * Inserts data of the file just uploaded into the database
	 * @param file name
	 * @param user session id
	 * @return id ( the id of the record just inserted ) 
	 * */
	public function insert_file($filename, $user_session_id)
	{
		$data = array(
				'file_name'    => $filename,
				'session_id'   => $user_session_id
		); 
		$this->db->insert('files', $data);
		return $this->db->insert_id();
	}
	
	/**
	 * Retrieves all the files based on session Id
	 * @param user_session_id ( id of current user session )
	 * @return id ( the id of the record just inserted )
	 * */
	public function get_files($user_session_id)
	{
		return $this->db->select()->from('files')->where('session_id', $user_session_id)->get()->result();
	}
	
	/**
	 * Deletes a file based on session id
	 * @param file_id ( file id )
	 * @return bool ( TRUE if the file exist , FALSE if the file does not exist )
	 * */
	public function delete_file($file_id)
	{
		$file = $this->get_file($file_id);
		if (!$this->db->where('id', $file_id)->delete('files'))	
		{
			return FALSE;
		}
		unlink($this->upload_folder .  $file->file_name);
		return TRUE;
	}
	
	/**
	 * Gets a file by id
	 * @param file_id ( id of the file )
	 * @return query result 
	 * */
	public function get_file($file_id)
	{
		return $this->db->select()->from('files')->where('id', $file_id)->get()->row();
	}

	/**
	 * Gets files that have been uploaded by an user
	 * @param user_session_id ( id of the user session )
	 * @return query result
	 * */
	public function get_user_files ($user_session_id)
	{
		$query = $this->db->select()->from('files')->where('session_id', $user_session_id)->where('post_id IS NULL')->get();
		return $query->result();
	}

	/**
	 * If post has been successfully uploaded, I assign to the post_id(foreign key) field of files table
	 * the id of the post, to bind images to an article
 	 * @param user_session_id ( id of the user session )
 	 * @param post_id (id of the post)
	 * */
	public function save_user_files ($user_session_id , $post_id)
	{
		foreach ($this->get_user_files($user_session_id) as $file) {
			$this->db->where('session_id', $user_session_id)->where('post_id IS NULL');
			$this->db->update("files" , array('post_id' => $post_id));
		}
	}
	
	/**
	 * Deletes all the files binded to an user
	 * @param user_session_id ( id of the user session )
	 * */
	public function delete_user_files ($user_session_id)
	{
		$query = $this->db->select()->from('files')->where('session_id', $user_session_id)->where('post_id IS NULL')->get();
		foreach ($query->result() as $file) {
			unlink($this->upload_folder .  $file->file_name);
			$this->db->delete('files', array('id' => $file->id));
		}
	}
	
	/**
	 * Gets the number of images binded to an user session id
	 * @param user_session_id ( id of the file )
	 * @return integer (number of files)
	 * */
	public function get_number_of_user_files ($user_session_id)
	{
		return $this->db->select()->from('files')->where('session_id', $user_session_id)->where('post_id IS NULL')->get()->num_rows();
	}

	/**
	 * Gets all the images binded to a post
	 * @param post_id ( id of the post )
	 * @return the query
	 * */
	public function get_post_images ($post_id)
	{
		return $this->db->select()->from('files')->where('post_id', $post_id)->get()->result();
	}

}