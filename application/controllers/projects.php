<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller
{

	public function index()
	{
		if($this->session->userdata('counter') == NULL)
		{
			$this->session->set_userdata('counter', 1);
		}
		else
		{
			$temp = $this->session->userdata('counter');
			$temp++;
			$this->session->set_userdata('counter', $temp);
		}

		$new_password = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789!@#$%^*[]';
		$pw = substr(str_shuffle($new_password), 0,8);

		$view_data = array('pw' => $pw);

		$this->load->model('ajax_post');
		$view_data['posts'] = $this->ajax_post->get_notes();

		$this->load->view('splash_view', $view_data);
	}

	public function superwide()
	{
		$this->load->view('superwide');
	}

	public function clear()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

}
?>