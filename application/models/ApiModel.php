<?php

defined('BASEPATH') or exit('No script access allowed.');

class ApiModel extends CI_Model
{
	public function getPopularArticle()
	{
		$v = $this->db->query("SELECT *, views_count + favorite_count as total FROM news WHERE removeAt = 0 AND type = 0 ORDER BY total DESC LIMIT 1")->result_array()[0];
		$category = $this->get_categories($v['category_id'])[0];
		$id = $v['type'] == 1 ? explode("https://www.youtube.com/watch?v=", $v['videoUrl'])[1] : '';
		$v['contents'] = addslashes(htmlspecialchars($v['contents']));
		$v['createAt'] = getDateFormat($v['createAt']);
		$v['videoId'] = $id;
		$v['category'] = $category['category'];
		unset($v['total']);
		return $v;
	}
	private function new_by_user_add($uid = 0, $token = null, $articleId = 0){
		if($uid > 0 && $token != null){
			$data['user_id'] = $uid;
			$data['news_id'] = $articleId;
			$data['createAt'] = time();
			$this->db->insert('news_by_user', $data);
			return $this->db->insert_id() > 0 ? true : false;
		}
		return false;
	}
	public function article_add($data = []){
		if(!isset($data['uid']) || !isset($data['token'])){
			return 0;
		}
		$user = $this->get_user(null, $data['uid'], $data['token']);
		if(count($user) > 0){
			unset($data['uid']);
			unset($data['token']);

			if(!isset($data['title']) || !isset($data['contents']) || !isset($data['type'])){
				return 0;
			}

			$data['createAt'] = time();
			$data['contents'] = addcslashes($data['contents']);
			if($data['type'] > 0){
				$data['videoUrl'] = $data['imageUrl'];
				unset($data['imageUrl']);
			}

			$this->db->insert("news", $data);

			if($this->db->insert_id() < 1){
				return 0;
			}

			$add = $this->new_by_user_add($user['id'], $user['token'], $this->db->insert_id());

			return $add ? ARTICLE_ADD_SUCCESS : 0;
		}else{
			return TOKEN_INVALID;
		}
	}
	public function article_view($id = 0, $type = 0, $category = 0){
		if($id < 1){
			return false;
		}
		$article = count($this->get_articles($id, 0, 1, $type, $category)) ? $this->get_articles($id, 0, 1, $type, $category)[0] : $this->get_articles($id, 0, 1, petype, $category);
		$viewCount = $article['views_count'] + 1;
		$this->db->where('id', $id);
		return $this->db->update('news', ['views_count' => $viewCount]);
	}
	public function article_favorite_update($uid = 0, $token = null, $articleId = 0, $type = 0, $category = 0)
	{
		if($articleId < 1 && $uid < 0 && $token == null){
			return false;
		}
		$user = $this->get_user(null, $uid, $token);
		if(count($user) > 0){
			$article = count($this->get_articles($articleId, 0, 1, $type, $category)) ? $this->get_articles($articleId, 0, 1, $type, $category)[0] : $this->get_articles($articleId, 0, 1, petype, $categoryty);
			$favoriteCount = $article['favorite_count'] + 1;
			$this->db->where('id', $articleId);
			$update =  $this->db->update('news', ["favorite_count" => $favoriteCount]);
			if($update){
				if($this->duplicateNewsFav($uid, $articleId)){
					return false;
				}
				$this->db->insert('news_favorites', [
					"news_id" => $articleId,
					"user_id" => $user['id'],
					"createAt" => time()
				]);
			}
		}else{
			return false;
		}
	}
	private function duplicateNewsFav($userId = 0, $articleId = 0){
		if($userId < 1 && $articleId < 0){
			return true;
		}
		$this->db->where('news_id', $articleId);
		$this->db->where('user_id', $userId);
		$data = $this->db->get('news_favorites');
		if($data->num_rows() > 0){
			return true;
		}
		return false;
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
			$result[$k]['contents'] = addslashes($v['contents']);
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

	public function get_user($email = null, $id = null, $token = null)
	{
		if($email != null)
		{
			$this->db->where('email', $email);
		}
		
		if($id != null)
		{
			$this->db->where('id', $id);
		}
		if($token != null)
		{
			$this->db->where('token', $token);
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
