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
		
		$data['posts'] = $this->ajax_post->get_notes();

		echo json_encode ($data['posts']);

	}

	public function delete()
	{
		$this->load->model('ajax_post');
		$data = array('id' => $this->input->get('id'));
		
		$this->ajax_post->delete_note($data);
		redirect(base_url('projects/index')); // turn this line off once the Ajax function is working(??)(but it's working now, and the line is still turned on - turning it off breaks it)
	}
	
}
?>