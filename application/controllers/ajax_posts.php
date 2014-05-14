<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_posts extends CI_Controller {

	public function index()
	{
		$this->load->model('ajax_post');
		$view_notes['posts'] = $this->ajax_post->get_notes();
		$this->load->view('splash_view', $view_notes);
	}
	public function create()
	{
		//add new record in the db and return JSON format results
		$this->load->model('ajax_post');

		$description = $this->input->post('description');

		// send data
		$data = array('description' => $description);

		$this->ajax_post->add_note($data);

		echo json_encode ($description);

	}

	public function delete($id)
	{
		
		$this->load->model('ajax_post');
		$data = array('id' => $id);
		// var_dump($data);
		// die();
		$this->ajax_post->delete_note($data);
		
	}
	
}
?>