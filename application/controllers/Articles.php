<?php

defined('BASEPATH') or exit("No script access allowed.");

class Articles extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('ArticleModel');
		$this->load->model('CategoryModel');

		if(!$this->AdminModel->verifyUser()){
			return json_encode(['status' => false]);
		}
	}

	public function index($page = null, $id = 0)
	{
		$this->load->view('header');
		$data['categories'] = $this->CategoryModel->get();

		if($page == "add"){
				$this->load->view('article/insert', $data);
		}
		else if($page == "edit"){
			$data['article'] = isset($this->ArticleModel->get($id)[0]) ? $this->ArticleModel->get($id)[0] : false;
			if(!$data['article']) exit("Data not found");
			$this->load->view('article/edit', $data);
		}
		else {
			$data['articles'] = $this->ArticleModel->get();
			$this->load->view('article/view', $data);
		}

		$this->load->view('footer');
	}

	public function update()
	{
		if($this->input->post())
		{
			$data = $this->clearData($this->input->post());
			$type = $data['type'];

			if($type == 0 && $_FILES['image']['name'] != null)
			{
				$data['imageUrl'] = $this->uploadImage();
			}else if($type == 2 && $_FILES['video']['name'] != null)
			{
				$data['videoUrl'] = $this->uploadVideo();
			}

			$this->ArticleModel->update($data);
			redirect(base_url().'articles', 'auto');
		}
	}

	public function remove($id = null)
	{
		if($id)
		{
			$this->ArticleModel->remove($id);
			redirect(base_url().'articles');
		}
	}

	public function insert()
	{
		if($this->input->post())
		{
			$data = $this->clearData($this->input->post());
			$data['createAt'] = time();
			$type = $data['type'];

			if($type == 0)
			{
				$data['imageUrl'] = $this->uploadImage();
			}else if($type == 2)
			{
				$data['videoUrl'] = $this->uploadVideo();
			}

			$this->ArticleModel->insert($data);
			redirect(base_url().'articles', 'auto');
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

	private function uploadVideo($name = 'video')
	{
		$config['upload_path']          = './uploads/videos/';
		$config['allowed_types']        = 'wmv|mp4|avi|mov';
		$config['max_size']             = 0;
		$config['encrypt_name']					= TRUE;
		$config['file_ext_tolower'] 		= TRUE;
		$this->load->library('upload', $config);

		if($this->upload->do_upload($name))
		{
			$video = $this->upload->data();
			return base_url().'uploads/videos/'.$video['file_name'];
		}else{
			echo "<pre>";
			print_r($this->upload->display_errors());
			echo "</pre>";
			exit();
		}
	}

	private function clearData($data = null)
	{
		if($data)
		{
			foreach($data as $k => $v)
			{
				if($v==null)
				{
					unset($data[$k]);
				}
			}

			if($data['type'] != 1)
			{
				unset($data['videoUrl']);
			}
		}
		return $data;
	}

}

