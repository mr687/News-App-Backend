<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index()
	{ 
		if ($this->AdminModel->verifyUser()) {
			redirect(base_url(), 'auto');
		} 
	}

	public function admins($page=null, $adminid=0) {
		if ($this->AdminModel->verifyUser()) {
			if ($this->input->post()){
				$postData = $this->input->post();
				$this->AdminModel->updateAdmins($postData, $postData["action"]);
			}
			if ($page == "add") {
				$data["admin_groups"] = $this->AdminModel->getAdminGroups();
				$this->load->view('header');
				$this->load->view('settings/admins_add', $data);
				$this->load->view('footer');
			} elseif ($page == "edit") {
				if ($adminid == null) { redirect(base_url(), 'auto'); }
				$data["admin_groups"] = $this->AdminModel->getAdminGroups();
				$data["result"] = $this->AdminModel->getAdminInfo($adminid);
				$this->load->view('header');
				$this->load->view('settings/admins_edit', $data);
				$this->load->view('footer');
			} else {
				$data["admins"] = $this->AdminModel->getAdmins();
				$this->load->view('header');
				$this->load->view('settings/admins', $data);
				$this->load->view('footer');
			} 	
		}
	}

	public function groups($page=null, $groupid=0) {
		if ($this->AdminModel->verifyUser()) {
			if ($this->input->post()){
				$postData = $this->input->post();
				$this->AdminModel->updateGroups($postData, $postData["action"]);
			}
			if ($page == "add") {
				$this->load->view('header');
				$this->load->view('settings/admingroups_add');
				$this->load->view('footer');
			} elseif ($page == "edit") {
				$data["result"] = $this->AdminModel->getAdminGroups($groupid);
				$this->load->view('header');
				$this->load->view('settings/admingroups_edit', $data);
				$this->load->view('footer');
			} else {
				$data["groups"] = $this->AdminModel->getAdminGroups();
				$this->load->view('header');
				$this->load->view('settings/groups', $data);
				$this->load->view('footer');
			} 
		}
	}
}
