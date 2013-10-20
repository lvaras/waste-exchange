<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	private $session_data;
	private $max_files_to_upload = 5;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form', 'home'));
		$this->load->library('form_validation');
		#$this->load->library('recaptcha');
		$this->load->model('post');
		$this->load->model('files');
		$this->load->database();
		$this->load->library('session');
		$this->session_data = $this->session->all_userdata();
	}
	
	/**
	 * Index...
	 * */
	public function index()
	{
		$data["posts"] = $this->post->get_posts();
		$this->load->view('templates/header');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Mostro pagina aggiungi
	 * */
	public function aggiungi()
	{
		/* settare virtual host per poterlo abilitare
		$data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		$data['page'] = 'home/inserisci_articolo'; */
		$this->files->delete_user_files( $this->session_data["session_id"] );
		$this->load->view('templates/header');
		$this->load->view('aggiungi_articolo');
		$this->load->view('templates/footer');
	}

	/**
	 * Inserisco un articolo
	 * */
	public function inserisci_articolo()
	{
		$form_rules = array(
			array(
					'field'   => 'article_name',
					'label'   => 'article_name',
					'rules'   => 'required'
			),
			array(
					'field'   => 'city',
					'label'   => 'city',
					'rules'   => 'required'
			),
			array(
					'field'   => 'address',
					'label'   => 'address',
					'rules'   => 'required'
			),
			array(
					'field'   => 'building_number',
					'label'   => 'building_number',
					'rules'   => 'required|numeric'
			),
			array(
					'field'   => 'email',
					'label'   => 'email',
					'rules'   => 'valid_email'
			)
		);
		
		$this->form_validation->set_rules($form_rules);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('templates/footer');
		}
		else
		{
			$inserted_post_id = $this->post->insert_post();
			$this->files->save_user_files( $this->session_data["session_id"] , $inserted_post_id);
			$this->load->view('templates/header');
			$this->load->view('success');
			$this->load->view('templates/footer');
		}
	}
	
	/**
	 * Carica un file in base a un title ricevuto in $_POST
	 * all'interno della cartella uploads
	 * */
	public function upload_file () 
	{
		$status = "";
		$msg = "";
		$file_element_name = 'da_file';
		$number_of_files = $this->files->get_number_of_user_files($this->session_data["session_id"]);
		
		if ( $number_of_files < $this->max_files_to_upload ) 
		{
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt';
			$config['max_size']  = 2048;
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
			}
			else
			{
				$data = $this->upload->data();
				$file_id = $this->files->insert_file($data['file_name'], $this->session_data["session_id"]);
				if($file_id)
				{
					$status = "success";
					$msg = "File successfully uploaded";
				}
				else
				{
					unlink($data['full_path']);
					$status = "error";
					$msg = "Something went wrong when saving the file, please try again.";
				}
			}
			@unlink($_FILES[$file_element_name]);
		}
		else 
		{
			$status = "error";
			$msg = "Max number of images is " . $this->max_files_to_upload;
		}
		
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	/**
	 * Recupero i file abbinati ad un annuncio in fase di caricamento
	 * 
	 * */
	public function files($user_session_id)
	{
		$files = $this->files->get_user_files($user_session_id);
		$this->load->view('files', array('files' => $files));
	}
	
	/**
	 * Cancello un immagine in base a un Id passato come parametro
	 * @param id ( file id )
	 * */
	public function delete_file($file_id)
	{
		if ($this->files->delete_file($file_id))
		{
			$status = 'success';
			$msg = 'File successfully deleted';
		}
		else
		{
			$status = 'error';
			$msg = 'Something went wrong when deleteing the file, please try again';
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	/**
	 * Recupero id sessione
	 * */
	public function get_session_id()
	{
		echo $this->session_data["session_id"];
	}
	
	
}

