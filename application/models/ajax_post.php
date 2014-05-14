<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_post extends CI_Model {

	public function add_note($data)
	{
		//adds new record in the db and return JSON format results
		date_default_timezone_set("America/Los_Angeles");
		$query = "INSERT INTO posts (description, created_at, updated_at)
				  VALUES ('{$data['description']}', NOW(), NOW())";
		$this->db->query($query);
		return TRUE;

		// redirect('/'); do this w/o ajax

	}

	public function get_notes()
		{
			$query = "SELECT * FROM posts
					  ORDER BY created_at DESC";
			return $this->db->query($query)->result_array();
		}

	public function delete_note($data)
	{
		// echo('dollar-data');
		// var_dump($data);
		// die();
		$query = "DELETE FROM posts WHERE id = {$data['id']}";
	// 	var_dump($query);
	// 	die();
	}
}
?>