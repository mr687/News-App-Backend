<?php
defined("BASEPATH") or exit("No script access allowed.");

class UserModel extends CI_Model
{
	public function remove($id)
	{
		if($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('users');
			return true;
		}
		return false;
	}

	public function banned($id = 0)
	{
		if($id)
		{
			$this->db->where('id', $id);
			$this->db->where('removeAt', 0);
			$data['removeAt'] = time();
			$this->db->update('users', $data);
			return true;
		}
		return false;
	}
	
	public function unbanned($id = 0)
	{
		if($id)
		{
			$this->db->where('id', $id);
			$data['removeAt'] = 0;
			$this->db->update('users', $data);
			return true;
		}
		return false;
	}

	public function get($id = null)
	{
		if($id != null){
			$this->db->where('id', $id);
		}

		return $this->db->get('users')->result();
	}
}
