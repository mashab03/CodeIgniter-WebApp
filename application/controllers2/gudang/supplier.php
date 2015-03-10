<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('supplier');
		
		$array=array(
			'id_supplier !='=>(int)""
			);
		$pages=100;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->database_library->ambil_data_array_custom($array,'id_supplier','asc',$pages,$page);

		$data['is_data']=$this->database_library->buat_paging('gudang/supplier/',$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('gudang/supplierview',$data);
		}else{
			redirect('gudang/supplier/addsupplier','refresh');
		}
	}
	
	function addsupplier()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		$this->secure_library->filter_post('alamat','required');
		$this->secure_library->filter_post('tlp','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$nama=$this->input->post('nama');
			$alamat=$this->input->post('alamat');
			$tlp=$this->input->post('tlp');
			$this->load->model('gudang/suppliermodel');
			if($this->suppliermodel->add_supplier($nama,$alamat,$tlp)==TRUE)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('gudang/addsupplier',$data);
			}
		}else{
			$this->load->view('gudang/addsupplier');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/suppliermodel');
		$data['nama']=$this->suppliermodel->get_supplier_by_id($id,"nama_supplier");
		$data['alamat']=$this->suppliermodel->get_supplier_by_id($id,"alamat");
		$data['tlp']=$this->suppliermodel->get_supplier_by_id($id,"telepon");
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('gudang/editsupplierview',$data);
		}else{
			redirect('gudang/supplier');
		}
	}
	
	function update()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/suppliermodel');
		$data=array(
				'nama_supplier'=>$this->input->post('nama'),
				'alamat'=>$this->input->post('alamat'),
				'telepon'=>$this->input->post('tlp'),						
			);
		if($this->suppliermodel->update_supplier($id,$data)==TRUE)
		{
			redirect('gudang/supplier');
		}else{
			redirect("gudang/supplier/updateview?uid=".$id."");
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/suppliermodel');
		if($this->suppliermodel->delete_supplier($id)==TRUE)
		{
			redirect('gudang/supplier');
		}else{
			redirect('gudang/supplier');
		}
	}
}