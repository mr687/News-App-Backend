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
		$data = $this->post();
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
		$email = $this->post()['email'];
		$password = $this->post()['password'];
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
		
	}

	public function like_post(){
		$uid = $this->post('uid');
		$token = $this->post('token');
	}

	public function articles_get()
	{
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$type = isset($_GET['type']) ? $_GET['type'] : 0;
		$category = isset($_GET['category']) ? $_GET['category'] : 0;
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

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
