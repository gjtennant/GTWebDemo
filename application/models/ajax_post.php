<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_post extends CI_Model {

	public function get_notes()
		{
			$query = "SELECT * FROM posts
					  ORDER BY created_at DESC";
			return $this->db->query($query)->result_array();
		}

	public function add_note($data)
	{
		date_default_timezone_set("America/Los_Angeles");
		
		$query = "INSERT INTO posts (description, created_at, updated_at)
				  VALUES ('{$data['description']}', NOW(), NOW())";
		$this->db->query($query);
		$query = "SELECT * FROM posts
				  ORDER BY created_at DESC
				  LIMIT 1";
		return$this->db->query($query)->row_array();
	}

	public function delete_note($data)
	{
		$query = "DELETE FROM posts WHERE id = {$data['id']}";
		$this->db->query($query);
	}
}
?>