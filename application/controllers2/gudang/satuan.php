<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('satuan_obat');
		
		$array=array(
			'id_satuan_obat !='=>(int)""
			);
		$pages=100;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->database_library->ambil_data_array_custom($array,'id_satuan_obat','asc',$pages,$page);

		$data['is_data']=$this->database_library->buat_paging('gudang/satuan/',$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('gudang/satuanview',$data);
		}else{
			redirect('gudang/satuan/addsatuan','refresh');
		}
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