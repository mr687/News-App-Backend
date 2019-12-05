<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		$data["error"] = 0;
		if ($this->input->post()){ 
			if ($this->session->userdata("loginattempts")) {
				echo "2";
				$postData = $this->input->post();
				$loginattempts = $this->session->userdata("loginattempts");
				if ($loginattempts > 4) { 
					$data["error"] = 1;
					$this->load->view('login', $data);
				 } else {
				 	$auth = $this->AdminModel->adminLogin($postData);
					if ($auth == true) {
						redirect(base_url()."admin", "auto");
					} else {
						$data["error"] = 2;
						$this->load->view('login', $data);
					}
				 } 
			} else {
				echo "1";
				$this->session->set_userdata("loginattempts", 0);
				$postData = $this->input->post();
				$auth = $this->AdminModel->adminLogin($postData);
				if ($auth == true) {
					redirect(base_url()."admin", "auto");
				} else {
					$data["error"] = 2;
					$this->load->view('login', $data);
				}
			} 
		} else {
			$this->load->view('login', $data);
		}
		
	}
}
