<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('kategori_obat');
		
		$array=array(
			'id_kategori_obat !='=>(int)"",
			);
		$pages=5;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->database_library->ambil_data_array_custom($array,'id_kategori_obat','asc',$pages,$page);

		$data['is_data']=$this->database_library->buat_paging('gudang/kategori/',$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('gudang/kategoriview',$data);
		}else{
			redirect('gudang/kategori/addkategori','refresh');
		}
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