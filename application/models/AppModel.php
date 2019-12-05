<?php
defined("BASEPATH") or exit("No script access allowed.");

class AppModel extends CI_Model
{
	public function getData()
	{
		$result['usersCount'] = $this->db->count_all_results('users');
		$result['categoryCount'] = $this->db->count_all_results('categories');
		$result['articleCount'] = $this->db->count_all_results('news');
		return $result;
	}
}
