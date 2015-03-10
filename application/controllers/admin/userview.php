<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userview extends CI_Controller {
	
	function index()
	{
		$this->load->model('admin/usermodel','um');
		$data['is_data']=$this->um->getUser();		
		$this->load->view('admin/userview',$data);
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('admin/usermodel');
		if($this->usermodel->delete_user($id)==TRUE)
		{
			redirect('admin/userview');
		}else{
			redirect('admin/userview');
		}
	}
	
	function changeakses()
	{
		$id=$_GET['uid'];
		$r=$_GET['r'];
		$this->load->model('admin/usermodel');
		if($this->usermodel->change_role_user($id,$r)==TRUE)
		{
			redirect('admin/userview');
		}else{
			redirect('admin/userview');
		}
	}
	
	function changestatus()
	{
		$id=$_GET['uid'];
		$r=$_GET['r'];
		$this->load->model('admin/usermodel');
		if($this->usermodel->change_status_user($id,$r)==TRUE)
		{
			redirect('admin/userview');
		}else{
			redirect('admin/userview');
		}
	}
}