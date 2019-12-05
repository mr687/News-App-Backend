<?php

defined('BASEPATH') or exit("No script access allowed.");

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');

		if(!$this->AdminModel->verifyUser()){
			return json_encode(['status' => false]);
		}
	}
	public function index($page = null, $id = 0)
	{
		$this->load->view('header');

		if($page == "edit") {
			if($id > 0){
				// $data['user'] = $this->UserModel->get($id)[0];
				$this->load->view('user/insert', $data);
			}else{
				$this->load->view('user/insert');
			}
		}
		else {
			$data['users'] = $this->UserModel->get();
			$this->load->view('user/view', $data);
		}

		$this->load->view('footer');
	}
	public function remove($id = 0)
	{
		$this->UserModel->remove($id);
		redirect(base_url().'users', 'auto');
	}
	public function banned($id = 0)
	{
		$this->UserModel->banned($id);
		redirect(base_url().'users', 'auto');
	}
	public function unbanned($id = 0)
	{
		$this->UserModel->unbanned($id);
		redirect(base_url().'users', 'auto');
	}
}

