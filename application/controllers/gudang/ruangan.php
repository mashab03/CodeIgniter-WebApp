<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ruangan extends CI_Controller {
	
	function index()
	{
		$this->load->model('gudang/Ruanganmodel');
		$data['is_data']=$this->Ruanganmodel->getRuangan();
			$this->load->view('gudang/ruanganview',$data);
		
	}
	
	function addruangan()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$nama=$this->input->post('nama');
			$this->load->model('gudang/ruanganmodel');
			if($this->ruanganmodel->add_ruangan($nama)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('gudang/addruanganview',$data);
			}
		}else{
			$this->load->view('gudang/addruanganview');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/ruanganmodel');
		$data['nama']=$this->ruanganmodel->get_ruangan_by_id($id);
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('gudang/editruanganview',$data);
		}else{
			redirect('gudang/ruangan');
		}
	}
	
	
	function update()
	{
		$id=$_GET['uid'];
		$nama=$_POST['nama'];
		$this->load->model('gudang/ruanganmodel');
		if($this->ruanganmodel->update_ruangan($id,$nama)==TRUE)
		{
			redirect('gudang/ruangan');
		}else{
			redirect('gudang/ruangan');
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/ruanganmodel');
		if($this->ruanganmodel->delete_ruangan($id)==TRUE)
		{
			redirect('gudang/ruangan');
		}else{
			redirect('gudang/ruangan');
		}
	}
}