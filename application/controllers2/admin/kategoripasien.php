<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategoripasien extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('kategori_pasien');
		
		$array=array(
			'id_kategori_pasien !='=>(int)"",
			);
		$pages=100;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->database_library->ambil_data_array_custom($array,'id_kategori_pasien','asc',$pages,$page);

		$data['is_data']=$this->database_library->buat_paging('admin/kategoripasien/',$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('admin/kategoripasienview',$data);
		}else{
			redirect('admin/kategoripasien/addkategori','refresh');
		}
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