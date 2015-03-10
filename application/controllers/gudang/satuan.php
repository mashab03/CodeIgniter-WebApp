<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan extends CI_Controller {
	
	function index()
	{
		$this->load->model('gudang/Satuanmodel');
		$data['is_data']=$this->Satuanmodel->getSatuan();
			$this->load->view('gudang/satuanview',$data);
		
	}
	
	function addsatuan()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$nama=$this->input->post('nama');
			$this->load->model('gudang/satuanmodel');
			if($this->satuanmodel->add_satuan($nama)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('gudang/addsatuanview',$data);
			}
		}else{
			$this->load->view('gudang/addsatuanview');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/satuanmodel');
		$data['nama']=$this->satuanmodel->get_satuan_by_id($id);
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('gudang/editsatuanview',$data);
		}else{
			redirect('gudang/satuan');
		}
	}
	
	
	function update()
	{
		$id=$_GET['uid'];
		$nama=$_POST['nama'];
		$this->load->model('gudang/satuanmodel');
		if($this->satuanmodel->update_satuan($id,$nama)==TRUE)
		{
			redirect('gudang/satuan');
		}else{
			redirect('gudang/satuan');
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/satuanmodel');
		if($this->satuanmodel->delete_satuan($id)==TRUE)
		{
			redirect('gudang/satuan');
		}else{
			redirect('gudang/satuan');
		}
	}
}