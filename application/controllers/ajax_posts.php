<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_posts extends CI_Controller {

	public function create()
	{
		//add new record in the db and return JSON format results
		$this->load->model('ajax_post');

		if ($this->input->post('address') != 'http://' || $this->input->post('contact') != '' || $this->input->post('comment') != '') 
		{
			redirect(base_url('projects/index'));
		} 
		else 
		{
			$description = mysql_real_escape_string($this->input->post('description'));

			$ip_addr = $this->input->ip_address();

			// send data
			$data = array('description' => $description, 'ip_addr' => $ip_addr);

			$this->ajax_post->add_note($data);
			
			$data['posts'] = $this->ajax_post->get_notes();

			echo json_encode ($data['posts']);
		}

	}

	public function delete()
	{
		$this->load->model('ajax_post');
		$data = array('id' => $this->input->get('id'));
		
		$this->ajax_post->delete_note($data);
		redirect(base_url('projects/index')); 
	}
	
}
?>