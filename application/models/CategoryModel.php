<?php
defined("BASEPATH") or exit("No script access allowed.");

class CategoryModel extends CI_Model
{
	public function insert($data)
	{
		if($data){
			$this->db->insert('categories', $data);
			return true;
		}
		return false;
	}
	public function remove($id)
	{
		if($id)
		{
			$category = $this->get($id)[0];
			
			$path = FCPATH . explode(base_url(), $category->imageUrl)[1];
			
			if(file_exists($path))
			{
				unlink($path);
			}

			$this->db->where('id', $id);
			$this->db->delete('categories');
		}
	}
	public function update($data)
	{
		if($data)
		{
			$this->db->where('id', $data['id']);
			unset($data['id']);
			$this->db->update('categories', $data);
			return true;
		}
		return false;
	}
	public function get($id = null)
	{
		if($id != null){
			$this->db->where('id', $id);
		}

		return $this->db->get('categories')->result();
	}
}
