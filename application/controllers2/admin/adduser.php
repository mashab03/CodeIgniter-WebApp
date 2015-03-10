<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adduser extends CI_Controller {
	
	function index()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('username','required');
		$this->secure_library->filter_post('password','required');
		$this->secure_library->filter_post('nama','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$this->load->model('admin/usermodel');
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$role=$this->input->post('akses');
			$nama=$this->input->post('nama');
			
			if($this->usermodel->create_user($username,$password,$role,$nama)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('admin/adduserview',$data);
			}
		}else{			
			$this->load->view('admin/adduserview');
		}
	}
	
}