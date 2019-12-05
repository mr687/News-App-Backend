<?php
defined("BASEPATH") or exit("No script access allowed.");

class ArticleModel extends CI_Model
{
	public function remove($id = null)
	{
		if($id)
		{
			$article = $this->get($id)[0];
			
			$path[] = FCPATH . explode(base_url(), $article->imageUrl)[1];
			$path[] = FCPATH . explode(base_url(), $article->videoUrl)[1];
			
			foreach($path as $item)
			{
				if(file_exists($item))
				{
					unlink($item);
				}
			}
			
			$this->db->where('id', $id);
			$this->db->delete('news');
			return true;
		}
		return false;
	}

	public function update($data = null)
	{
		if($data)
		{
			$this->db->where('id', $data['id']);
			unset($data['id']);

			$this->db->update('news', $data);
		}
	}

	public function insert($data = null)
	{
		if($data != null)
		{
			$this->db->insert('news', $data);
		}
	}

	private function getCategories($id = null)
	{
		if($id)
		{
			$this->db->where('id', $id);
			return $this->db->get('categories')->result()[0];
		}
	}

	public function get($id = null)
	{
		if($id != null){
			$this->db->where('id', $id);
		}
		$result = $this->db->get('news')->result();
		
		foreach($result as $k => $v)
		{
			$category = $this->getCategories($v->category_id);
			$v->category = $category->category;
		}

		return $result;
	}
}
