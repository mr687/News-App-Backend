<?php

defined('BASEPATH') or exit('No script access allowed.');

class ApiModel extends CI_Model
{
	public function getPopularArticle()
	{
		$v = $this->db->query("SELECT *, views_count + comment_count as total FROM news WHERE removeAt = 0 AND type = 0 ORDER BY total DESC LIMIT 1")->result_array()[0];
		$category = $this->get_categories($v['category_id'])[0];
		$id = $v['type'] == 1 ? explode("https://www.youtube.com/watch?v=", $v['videoUrl'])[1] : '';
		$v['contents'] = addslashes(htmlspecialchars($v['contents']));
		$v['createAt'] = getDateFormat($v['createAt']);
		$v['videoId'] = $id;
		$v['category'] = $category['category'];
		unset($v['total']);
		return $v;
	}
	public function get_articles($id = null, $offset = 0, $limit = 10, $type = 0, $category = 0){
		if($id)
		{
			$this->db->where('id', $id);
		}
		if($category > 0)
		{
			$this->db->where('category_id', $category);
		}
		$this->db->where('type', $type);
		$this->db->where('removeAt', 0);
		$this->db->limit($limit, $offset);
		$this->db->order_by('createAt', 'desc');
		$result = $this->db->get('news')->result_array();
		foreach($result as $k => $v)
		{
			$category = $this->get_categories($v['category_id'])[0];
			$id = $v['type'] == 1 ? explode("https://www.youtube.com/watch?v=", $v['videoUrl'])[1] : '';
			$result[$k]['contents'] = addslashes(htmlspecialchars($v['contents']));
			$result[$k]['createAt'] = getDateFormat($v['createAt']);
			$result[$k]['videoId'] = $id;
			$result[$k]['category'] = $category['category'];
		}
		return $result;
	}
	public function get_categories($id = null)
	{
		if($id)
		{
			$this->db->where('id', $id);
		}
		$result = $this->db->get('categories')->result();
		$data = [];
		foreach($result as $k => $v){
			$data[$k]['id'] = $v->id;
			$data[$k]['category'] = $v->category;
			$data[$k]['imageUrl'] = $v->imageUrl;
			$data[$k]['createAt'] = getDateFormat($v->createAt);
			$data[$k]['removeAt'] = $v->removeAt;
		}
		return $data;
	}
	public function insert_user($data)
	{
		$user = $this->get_user($data['email']);
		if(count($user) > 0){
			return EMAIL_EXISTS;
		}

		$this->db->insert('users', $data);
		return $this->db->insert_id() > 0 ? REGISTER_SUCCESS: 0;
	}

	public function get_user($email = null, $id = null)
	{
		if($email != null)
		{
			$this->db->where('email', $email);
		}
		
		if($id != null)
		{
			$this->db->where('id', $id);
		}
		$this->db->limit(1);
		$result = $this->db->get('users')->result_array();
		return  count($result) > 0 ? $result[0] : $result;
	}

	public function update_user_token($token, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', ['token'=>$token]);
	}
}
