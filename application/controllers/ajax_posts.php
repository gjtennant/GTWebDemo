<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_posts extends CI_Controller {

	public function create()
	{
		//add new record in the db and return JSON format results
		$this->load->model('ajax_post');

		$description = mysql_real_escape_string($this->input->post('description'));

		// send data
		$data = array('description' => $description);

		$this->ajax_post->add_note($data);

		// *** I think we also need to add another db query in which we pull out what was just entered, because right now we're only showing the real_escape_string, so it looks bad ***
		
		// *** As a matter of fact that query is already happening on first page load, so let's see about doubling up on the usage here **

		echo json_encode ($description);

	}

	public function delete()
	{
		$this->load->model('ajax_post');
		$data = array('id' => $this->input->get('id'));
		
		$this->ajax_post->delete_note($data);
		// var_dump($data);
		// die();
		redirect(base_url('projects/index')); // turn this line off once the Ajax function is working
	}
	
}
?>