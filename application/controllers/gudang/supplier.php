<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
	function index()
	{
		$this->load->model('gudang/suppliermodel','sm');
		$data['is_data']=$this->sm->getSupplier();
		$this->load->view('gudang/supplierview',$data);
		
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