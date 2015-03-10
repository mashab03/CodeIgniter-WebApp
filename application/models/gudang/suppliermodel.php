<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliermodel extends CI_Model {
	
	function fetch_supplier()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('supplier');
		$isdata=$this->database_library->ambil_data();
		if(!empty($isdata))
		{
			return true;
		}else{
			return false;
		}
	}
	
	function getSupplier()
	{
		
		$this->load->library('database_library');
		
		$search="";
		$url='';
		
		$url=base_url('gudang/supplier').'?paging=true&';		
		$page = isset($_GET['page']) ? mysql_real_escape_string($_GET['page']) : '1';
		
		$limit=10;
		$offset = ($page - 1) * $limit;
		$sql="SELECT * FROM supplier limit $offset,$limit";
		$sql2="SELECT * FROM supplier";
		$datas=$this->database_library->QueryData($sql);;
		$TR=$this->database_library->QueryNumRow($sql2);
		
		
		$tpage=ceil($TR/$limit);
		$this->load->library('pagination_library');
		$data['links']=$this->pagination_library->paginate_anchor($url,$page,$TR,$limit);
		$data['results']=$datas;
		
		return $data;
	}
	
	function get_supplier_by_id($id,$output)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('supplier');
		$isdata=$this->database_library->ambil_satu_data('id_supplier',$id,$output);
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function jika_ada($nama)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('supplier');
		$arr=array(
			'nama_supplier'=>$nama,
			);
		if($this->database_library->jika_ada($arr)==TRUE)
		{
			return true;
		}else{
			return false;
		}
		
	}
	
	function add_supplier($nama,$alamat,$tlp)
	{
		$this->load->library('database_library');
		if($this->jika_ada($nama)==FALSE)
		{
			$this->database_library->pake_table('supplier');		
			$arr=array(
				'nama_supplier'=>$nama,
				'alamat'=>$alamat,
				'telepon'=>$tlp,
				);
			if($this->database_library->tambah_data($arr)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function update_supplier($id,$data)
	{
		$this->load->library('database_library');
		
			$this->database_library->pake_table('supplier');		
			$arr=array(
				'id_supplier'=>$id,
				);			
			if($this->database_library->ubah_data($arr,$data)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		
	}
	
	function delete_supplier($idKategori)
	{
		$this->load->library('database_library');
		
			$this->database_library->pake_table('supplier');		
			$arr=array(
				'id_supplier'=>$idKategori,
				);
			if($this->database_library->hapus_data($arr)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		
	}
	
}