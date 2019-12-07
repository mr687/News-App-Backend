<?php

defined("BASEPATH") or exit("No direct script access  allowed.");

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
	function __construct(){
		parent::__construct();
		$this->load->model('ApiModel');
	}

	public function user_register_post()
	{
		$data = $this->post(null, true);
		$data['createAt'] = time();
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		$result = $this->ApiModel->insert_user($data);

		if($result == EMAIL_EXISTS){
			$this->response([
				"status" => false,
				"message" => "Email is already exists."
			], 200);
		}else if($result == REGISTER_SUCCESS){
			$this->response([
				"status" => true,
				"message" => "Registration successfully."
			], 200);
		}else{
			$this->response([
				"status" => false,
				"message" => "Registration failed."
			], 200);
		}
	}

	public function user_login_post()
	{
		$email = $this->post('email', true);
		$password = $this->post('password', true);
		$user = $this->ApiModel->get_user($email);

		$result = [];

		if(count($user) > 0)
		{
			if(password_verify($password, $user['password']))
			{
				// update token
				$token = generateUserToken($user);
				$this->ApiModel->update_user_token($token, $user['id']);
				$user = $this->ApiModel->get_user($email);
				unset($user['password']);
				unset($user['last_login']);

				$result['status'] = true;
				$result['message'] = "Success";
				$result['user'] = $user;
			}
			else
			{
				$result['status'] = false;
				$result['message'] = "Wrong password.";
			}
		}
		else
		{
			$result['status'] = false;
			$result['message'] = "Email not found.";
		}
		$this->response($result, 200);
	}

	public function request_token_post()
	{
		$uid = 1;

		$result['status'] = false;
		$result['message'] = "Something wrong.";
		$result['user'] = [];

		$user = $this->ApiModel->get_user(null, $uid);
		if(count($user) > 0)
		{
			$token = generateUserToken($user);
			$this->ApiModel->update_user_token($token,$user['id']);

			$user = $this->ApiModel->get_user(null, $uid);
			unset($user['password']);
			
			$result['status'] = true;
			$result['message'] = "Success";
			$result['user'] = $user;
		}

		$this->response($result, 200);
	}

	public function view_post(){
		$articleId = $this->post("articleId", true);

		$update = $this->ApiModel->article_view($articleId);
		if($update){
			$this->response(
				[
					"status" => true,
					"message" => "Success"
				],
				200
			);
		}else{
			$this->response(
				[
					"status" => false,
					"message" => "Failed"
				],
				200
			);
		}
	}

	public function like_post(){
		$uid = $this->post('uid', true);
		$token = $this->post('token', true);
		$articleId = $this->post('articleId', true);

		$update = $this->ApiModel->article_favorite_update($uid, $token, $articleId);
		if($update){
			$this->response(
				[
					"status" => true,
					"message" => "Success"
				],
				200
			);
		}else{
			$this->response(
				[
					"status" => false,
					"message" => "Failed"
				],
				200
			);
		}
	}

	private function uploadImage($name = "image")
	{
		$config['upload_path']          = './uploads/article/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$config['encrypt_name']					= TRUE;
		$config['file_ext_tolower'] 		= TRUE;
		$this->load->library('upload', $config);

		if($this->upload->do_upload($name))
		{
			$image = $this->upload->data();
			return base_url().'uploads/article/'.$image['file_name'];
		}else{
			echo "<pre>";
			print_r($this->upload->display_errors());
			echo "</pre>";
			exit();
		}
	}

	public function article_image_post(){
		$uid = $this->post("uid", true);
		$token = $this->post("token", true);

		if($uid == null || $uid ==null){
			$this->response([
				"status" => false,
				"message" => "Failed"
			], 200);
		}

		$user = $this->ApiModel->get_user(null, $uid, $token);
		unset($user['password']);
		unset($user['token']);
		unset($user['id']);
		unset($user['last_login']);

		if($user){
			$imageUrl = $this->uploadImage("upload");
			if($imageUrl != null){
				$this->response([
					"status" => true,
					"message" => "Success",
					"imageUrl" => $imageUrl
				], 200);
			}else{
				$this->response([
					"status" => false,
					"message" => "Failed"
				], 200);
			}
		}else{
			$this->response([
				"status" => false,
				"message" => "Failed"
			], 200);
		}
	}

	public function article_add_post(){
		$data = $this->post(null, true);
		$data['createAt'] = time();

		$result = $this->ApiModel->article_add($data);

		$print = [];
		if($result == TOKEN_INVALID){
			$print['status'] = false;
			$print['message'] = "Token access invalid.";
		}else if($result == ARTICLE_ADD_SUCCESS){
			$print['status'] = true;
			$print['message'] = "Success";
		}else{
			$print['status'] = false;
			$print['message'] = "Failed";
		}
		$this->response($print, 200);
	}

	public function articles_get()
	{
		$uid = $this->post('uid', true);
		$offset = $this->get('offset', true) != null ? $this->get('offset', true) : 0;
		$limit = $this->get('limit', true) != null ? $this->get('limit', true) : 10;
		$type = $this->get('type', true) != null ? $this->get('type', true) : 0;
		$category = $this->get('category', true) != null ? $this->get('category', true) : 0;
		$id = $this->get('id', true) != null ? $this->get('id', true) : 0;

		$data = $this->ApiModel->get_articles($id, $offset, $limit, $type, $category);
		
		if($data)
		{
			$result['status'] = true;
			$result['messages'] = 'Success';
			$result['total'] = count($data);
			if($type == 0 && $id < 1) $result['popular'] = $this->ApiModel->getPopularArticle();
			if($id > 0) $result['articles'] = $data[0];
			if($id == 0) $result['articles'] = $data;
			$this->response($result, 200);
		}else{
			$result['status'] = false;
			$result['messages'] = 'Data empty';
			$this->response($result, 200);
		}
	}

	public function categories_get()
	{
		$data = $this->ApiModel->get_categories();
		if(count($data) > 0)
		{
			if($data)
			{
				$result['status'] = true;
				$result['messages'] = 'Success';
				$result['categories'] = $data;
				$this->response($result, 200);
			}
			else
			{
				$this->response(
					[
						'status' => false,
						'message' => 'Categories empty',
						'categories' => [],
					], 404 );
			}
		}
	}
}
