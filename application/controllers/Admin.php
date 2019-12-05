<?php

defined("BASEPATH") or exit("No script access allowed.");

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel');
	}
	public function index()
	{
		if($this->AdminModel->verifyUser())
		{
			$this->load->view('header');
			$data['data'] = $this->AppModel->getData();
			$this->load->view('welcome_message', $data);
			$this->load->view('footer');
		}
	}
}
