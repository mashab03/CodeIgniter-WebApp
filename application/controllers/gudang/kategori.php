<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	function index()
	{
		$this->load->model('gudang/Kategorimodel');
		$data['is_data']=$this->Kategorimodel->getKategori();
			$this->load->view('gudang/kategoriview',$data);
		
	}
	
	function addkategori()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$nama=$this->input->post('nama');
			$this->load->model('gudang/kategorimodel');
			if($this->kategorimodel->add_kategori($nama)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('gudang/addkategoriview',$data);
			}
		}else{
			$this->load->view('gudang/addkategoriview');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/kategorimodel');
		$data['nama']=$this->kategorimodel->get_kategori_by_id($id);
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('gudang/editkategoriview',$data);
		}else{
			redirect('gudang/kategori');
		}
	}
	
	
	function update()
	{
		$id=$_GET['uid'];
		$nama=$_POST['nama'];
		$this->load->model('gudang/kategorimodel');
		if($this->kategorimodel->update_kategori($id,$nama)==TRUE)
		{
			redirect('gudang/kategori');
		}else{
			redirect('gudang/kategori');
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/kategorimodel');
		if($this->kategorimodel->delete_kategori($id)==TRUE)
		{
			redirect('gudang/kategori');
		}else{
			redirect('gudang/kategori');
		}
	}
}