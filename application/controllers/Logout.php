<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{ 
		$this->AdminModel->logout();
		redirect(base_url().'admin', 'auto');
		
	}
}
