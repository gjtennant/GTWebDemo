<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller
{

	public function index()
	{
		$new_password = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789!@#$%^*[]';
		$pw = substr(str_shuffle($new_password), 0,8);
		$view_data = array('pw' => $pw);

		$this->load->model('ajax_post');
		$view_data['posts'] = $this->ajax_post->get_notes();

		// var_dump($view_data);
		// die();

		$this->load->view('splash_view', $view_data);
	}

	public function generate()
	{
		$new_password = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789!@#$%^*[]';
		$pw = substr(str_shuffle($new_password), 0,8);
		echo json_encode ($pw);
	}

	public function superwide()
	{
		$this->load->view('superwide');
	}

}
?>