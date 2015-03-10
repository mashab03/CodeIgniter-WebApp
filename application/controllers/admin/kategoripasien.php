<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategoripasien extends CI_Controller {
	
	function index()
	{
		$this->load->model('admin/kategoripasienmodel','km');
		$data['is_data']=$this->km->getKategori();		
		$this->load->view('admin/kategoripasienview',$data);
		
	}
	
	function addkategori()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$nama=$this->input->post('nama');
			$this->load->model('admin/kategoripasienmodel');
			if($this->kategoripasienmodel->add_kategori($nama)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('admin/addkategoripasienview',$data);
			}
		}else{
			$this->load->view('admin/addkategoripasienview');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('admin/kategoripasienmodel');
		$data['nama']=$this->kategoripasienmodel->get_kategori_by_id($id);
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('admin/editkategoripasienview',$data);
		}else{
			redirect('admin/kategori');
		}
	}
	
	
	function update()
	{
		$id=$_GET['uid'];
		$nama=$_POST['nama'];
		$this->load->model('admin/kategoripasienmodel');
		if($this->kategoripasienmodel->update_kategori($id,$nama)==TRUE)
		{
			redirect('admin/kategoripasien');
		}else{
			redirect('admin/kategoripasien');
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('admin/kategoripasienmodel');
		if($this->kategoripasienmodel->delete_kategori($id)==TRUE)
		{
			redirect('admin/kategoripasien');
		}else{
			redirect('admin/kategoripasien');
		}
	}
}