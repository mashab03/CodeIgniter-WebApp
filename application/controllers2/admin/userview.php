<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userview extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		
		$array=array(
			'id_user !='=>(int)"",
			'role_special !='=>"admin",
			);
	$pages=100;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->database_library->ambil_data_array_custom($array,'id_user','asc',$pages,$page);

		$data['is_data']=$this->database_library->buat_paging(base_url('admin/userview/'),$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('admin/userview',$data);
		}else{
			redirect('admin/adduser','refresh');
		}
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