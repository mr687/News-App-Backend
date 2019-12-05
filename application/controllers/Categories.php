<?php

defined('BASEPATH') or exit("No script access allowed.");

class Categories extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoryModel');
	}
	public function index($page = null, $id = 0)
	{
		if($this->AdminModel->verifyUser())
		{
			$this->load->view('header');

			if($page == "add") {
				$this->load->view('category/insert');
			}
			else if($page == "edit") {
				$data['category'] = $this->CategoryModel->get($id)[0];
				$this->load->view('category/insert', $data);
			}
			else {
				$data['categories'] = $this->CategoryModel->get();
				$this->load->view('category/view', $data);
			}

			$this->load->view('footer');
		}
	}

	public function remove($id = 0){
		if($this->AdminModel->verifyUser())
		{
			$this->CategoryModel->remove($id);
			redirect(base_url().'categories', 'auto');
		}
	}

	public function update()
	{
		if($this->AdminModel->verifyUser())
		{
			if($this->input->post())
			{
				$data = $this->input->post();
				if($_FILES['image']['name'])
				{
					$config['upload_path']          = './uploads/category/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 1024;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					if($this->upload->do_upload('image'))
					{
						$image = $this->upload->data();
						$data['imageUrl'] = base_url().'uploads/category/'.$image['file_name'];
					}else{
						echo "<pre>";
						print_r($this->upload->display_errors());
						echo "</pre>";
						exit();
					}
				}else{
					$this->CategoryModel->update($data);
					redirect(base_url().'categories', 'auto');
				}
			}
		}
	}

	public function insert()
	{
		if($this->AdminModel->verifyUser())
		{
			if($this->input->post())
			{
				$data = $this->input->post();
				$config['upload_path']          = './uploads/category/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);

				if($this->upload->do_upload('image'))
				{
					$image = $this->upload->data();
					
					$data['imageUrl'] = base_url().'uploads/category/'.$image['file_name'];
					$data['createAt'] = time();
					$this->CategoryModel->insert($data);
					
					redirect(base_url().'categories', 'auto');
				}else{
					echo "<pre>";
					print_r($this->upload->display_errors());
					echo "</pre>";
					exit();
				}
			}
		}
	}
}

